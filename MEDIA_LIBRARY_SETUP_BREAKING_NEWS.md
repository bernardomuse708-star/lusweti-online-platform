# Media Library Setup Guide for Breaking News, Videos, External Articles & Images

## Overview
This document describes how images, local videos, YouTube links, and extracted OG images from external URLs are seeded in PostgreSQL and displayed across the frontend and updated via Filament.

---

## Architecture

### Models & Media Collections

#### **1. BreakingNews Model** (`app/Models/BreakingNews.php`)
- **Media Collection**: `featured_image` (single image)
- **Media Conversions**: `thumb` (400×225), `hero` (1200×675)
- **Accessors**:
  - `$item->image_url` → Hero-sized image URL
  - `$item->image_thumb_url` → Thumbnail image URL
- **OG Extraction Method**: `$breakingNews->extractAndAttachOgImage($externalUrl)` → Scrapes and attaches OG image from any external URL

#### **2. Video Model** (`app/Models/Video.php`)
- **Media Collections**:
  - `clip_payload` (single MP4 video file)
  - `video_thumbnail` (single thumbnail image)
- **Media Conversions**: `optimized` (800×450 WebP), `thumb` (400×225)
- **Attributes**:
  - `$video->is_youtube` → Boolean (true if has youtube_id)
  - `$video->video_url` → YouTube embed URL or local MP4 URL
  - `$video->image_path` → Thumbnail image hero URL
  - `$video->image_thumb_url` → Thumbnail image small URL
- **Data Fields**:
  - `youtube_id` (11 chars) → YouTube Video ID
  - `is_visible`, `published_at`

#### **3. Article Model** (`app/Models/Article.php`)
- **Media Collection**: `featured_image` (single image)
- **Media Conversions**: `thumb` (400×225), `hero` (1200×675)
- **Accessors**:
  - `$article->featured_image_url` → Hero-sized image URL
  - `$article->featured_image_thumb_url` → Thumbnail URL
- **OG Extraction**: Automatic via `ScrapeExternalArticleCover` job when `external_url` is changed
  - Dispatched in booted() after article is saved

---

## Database Seeding

### 1. Breaking News Seeder (`database/seeders/BreakingNewsSeeder.php`)
- Creates sample breaking news items
- Attaches `featured_image` from `public/storage/seeds/article-soka.jpg`
- Uses `addMedia()->toMediaCollection('featured_image')`

**Command**: `php artisan db:seed --class=BreakingNewsSeeder`

### 2. Video Teaser Seeder (`database/seeders/VideoTeaserRowSeeder.php`)
- Creates 4 YouTube videos + 1 local video entry
- Attaches video thumbnails from `public/storage/seeds/article-soka.jpg`
- Attaches local MP4 clip from `public/storage/1/01KSQTCDQBKT92ZGA30H7XCY0P.mp4` for local video entry
- Uses `addMedia()->toMediaCollection('clip_payload')` and `toMediaCollection('video_thumbnail')`

**Command**: `php artisan db:seed --class=VideoTeaserRowSeeder`

### 3. External Article Seeder (`database/seeders/ExternalArticleSeeder.php`)
- Creates external article entries
- Attempts to extract OG image from external_url via HTTP request
- Falls back to `public/storage/seeds/article-soka.jpg` if extraction fails
- Uses `addMedia()->toMediaCollection('featured_image')`

**Command**: `php artisan db:seed --class=ExternalArticleSeeder`

---

## Filament Admin Updates

### 1. BreakingNews Resource (`app/Filament/Resources/BreakingNews/`)

**Form** (`Schemas/BreakingNewsForm.php`):
- `title` → TextInput (auto-generates slug)
- `url` → TextInput with **OG extraction action button** ☁️
  - Click to extract featured image from external URL
  - Calls `$breakingNews->extractAndAttachOgImage($url)`
- `is_active`, `is_live`, `is_urgent` → Toggle switches
- `expires_at` → DateTimePicker
- `priority` → Numeric input
- `featured_image` → SpatieMediaLibraryFileUpload (image editor enabled)

**Workflow**: Upload image directly OR click extraction button to pull from external URL

### 2. Video Resource (`app/Filament/Resources/Videos/`)

**Form** (`Schemas/VideoForm.php`):
- `video_source_type` → Reactive dropdown (YouTube | Local MP4)
  - If "YouTube": Show `youtube_id` field (11 chars)
  - If "Local": Show `clip_payload` upload (MP4, WebM, MOV, AVI)
- `video_thumbnail` → SpatieMediaLibraryFileUpload (always visible)
- Conversions auto-generate after upload

**Workflow**: Choose source → Fill YouTube ID or upload MP4 → Add thumbnail → Publish

### 3. External Articles Resource (`app/Filament/Resources/ExternalArticles/`)

**Form** (`Schemas/ExternalArticleForm.php`):
- `external_url` → TextInput with **OG extraction action button** ☁️
  - Extracts og:image and og:title metadata
  - Auto-fills title and thumbnail
- `featured_image` → SpatieMediaLibraryFileUpload (fallback or manual override)

**Workflow**: Paste URL → Click extraction → Auto-populates title & image

### 4. Article Resource (`app/Filament/Resources/Articles/`)

**Form** (`Schemas/ArticleForm.php`):
- `featured_image` → SpatieMediaLibraryFileUpload
- Automatic OG extraction via job when `external_url` is set on save

---

## Frontend Display

### 1. Breaking News Ticker (`resources/views/livewire/frontend/breaking-news.blade.php`)
- **Current**: Text-only scrolling ticker with live badge
- **Accessors Used**: `$item->display_title`, `$item->url`
- **Planned Enhancement**: Optional featured image badge or modal display

### 2. Video Teaser Row (`resources/views/livewire/frontend/video-teaser-row.blade.php`)
- **Thumbnail Display**:
  - YouTube: `<img src="https://i.ytimg.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg">`
  - Local MP4: `<video src="{{ $video->video_url }}" preload="metadata" muted>`
- **Accessors Used**: `$video->is_youtube`, `$video->video_url`, `$video->image_path`

### 3. External Article Row (`resources/views/livewire/frontend/external-article-row.blade.php`)
- **Image Display**: `$article->getFirstMediaUrl('featured_image', 'thumb')`
- **Link Target**: Opens external URL in new tab

### 4. Other Article Rows
- All use `$article->featured_image_url` or `$article->featured_image_thumb_url` accessors
- Fallback: `asset('images/placeholders/article-default.jpg')`

---

## Media Storage Paths

All media files stored in:
```
public/storage/{UUID-CHAR}/filename.{ext}
storage/app/public/{UUID-CHAR}/filename.{ext}  (symlinked alias)
```

**Seed Assets** (fallbacks):
```
public/seeds/article-soka.jpg
public/seeds/article-burudani.jpg
```

**Local Video Examples** (for seeding local videos):
```
public/storage/1/01KSQTCDQBKT92ZGA30H7XCY0P.mp4
public/storage/2/01KSQ96EWNNKJYQAJ9AR2WBCJC.mp4
... (existing files)
```

---

## API/Accessor Quick Reference

| Model | Accessor | Returns |
|-------|----------|---------|
| BreakingNews | `$item->image_url` | Hero image URL (1200×675) |
| BreakingNews | `$item->image_thumb_url` | Thumb image URL (400×225) |
| Video | `$video->video_url` | YouTube embed URL or local MP4 URL |
| Video | `$video->image_path` | Thumbnail hero URL |
| Video | `$video->image_thumb_url` | Thumbnail small URL |
| Video | `$video->is_youtube` | Boolean |
| Article | `$article->featured_image_url` | Hero image URL (1200×675) |
| Article | `$article->featured_image_thumb_url` | Thumb image URL (400×225) |

---

## Jobs & Background Processing

### `ScrapeExternalArticleCover` Job (`app/Jobs/ScrapeExternalArticleCover.php`)
- **Triggered**: When Article is saved with changed `external_url`
- **Task**: 
  1. Fetches external URL HTML
  2. Extracts og:image or twitter:image meta tag
  3. Resolves relative image URLs to absolute
  4. Downloads image via HTTP
  5. Attaches to `featured_image` media collection
- **Fallback**: If extraction fails, article keeps existing image
- **Queue**: Runs on default queue (see `config/queue.php`)

---

## Broadcasting Events

### BreakingNews Updates
- **Event**: `BreakingNewsUpdated` (broadcasts on `breaking-news` channel)
- **Triggered**: When BreakingNews is created, updated, or deleted
- **Frontend Listener**: `#[On('echo:breaking-news,breaking.updated')]` in Livewire components

### Video Updates
- **Event**: `VideoFeedUpdated` (broadcasts on `videos` channel)
- **Triggered**: When Video is saved or deleted (via VideoObserver)
- **Frontend Listener**: `#[On('echo:videos,.feed.updated')]` in VideoTeaserRow

### Article Updates
- **Event**: `ArticlePublished` (broadcasts on channel per category)
- **Triggered**: When Article is saved or deleted
- **Frontend Listener**: Livewire components listening for article streams

---

## Complete Seed Command

To seed all media data:

```bash
php artisan migrate:fresh --seed
# OR individual seeders:
php artisan db:seed --class=BreakingNewsSeeder
php artisan db:seed --class=VideoTeaserRowSeeder
php artisan db:seed --class=ExternalArticleSeeder
```

---

## Example Filament Workflow

### Adding Breaking News with OG Image:
1. Filament: Breaking News Resource → Create
2. Fill `title`, `url`, set `is_active`, `is_live`
3. Click **"Extract Featured Image from URL"** button
4. System fetches og:image from URL and attaches
5. Click **Save**
6. Breaking News appears in frontend ticker with image

### Adding YouTube Video:
1. Filament: Videos Resource → Create
2. Fill `title`, select `video_source_type` = "External YouTube Link"
3. Enter `youtube_id` (11 chars, e.g., `rAkZb6HUP8g`)
4. Upload `video_thumbnail` image
5. Set `published_at`, select category
6. Click **Save**
7. Video appears in frontend with YouTube thumbnail

### Adding Local MP4 Video:
1. Filament: Videos Resource → Create
2. Fill `title`, select `video_source_type` = "Local Server MP4 Upload"
3. Upload `clip_payload` (MP4 file)
4. Upload `video_thumbnail` image
5. Set `published_at`, select category
6. Click **Save**
7. Video appears in frontend with local MP4 player and custom thumbnail

---

## Troubleshooting

**Images not showing in frontend?**
- Verify storage symlink: `php artisan storage:link`
- Check S3/public disk config in `config/filesystems.php`
- Confirm media files exist: `storage/app/public/` or `public/storage/`

**OG extraction fails for external URL?**
- URL may block HTTP requests (check robots.txt, User-Agent)
- HTML structure may differ (regex may not match meta tags)
- Check logs: `storage/logs/laravel.log`

**Videos not playing?**
- Local MP4: Verify file exists and is readable
- YouTube: Check `youtube_id` format (11 chars)
- Browser: Ensure CORS is configured if serving from different domain

**Media not attached after seeding?**
- Spatie Media Library may fail silently on permission issues
- Check `storage/logs/laravel.log` for exceptions
- Verify `public/storage` is writable: `chmod -R 755 public/storage`

---

## Configuration Files

- **Media Library Config**: `config/media-library.php` (Laravel Spatie)
- **Queue Config**: `config/queue.php` (Job processing)
- **Broadcasting Config**: `config/broadcasting.php` (WebSocket/Echo)
- **Filesystem Config**: `config/filesystems.php` (Storage disk setup)

---

**Created**: May 30, 2026  
**Last Updated**: May 30, 2026  
**Version**: 1.0
