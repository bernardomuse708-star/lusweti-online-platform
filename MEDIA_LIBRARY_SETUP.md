# Spatie Media Library Setup Guide

This document outlines the Media Library integration for the Lusweti Online Platform.

## Overview

Spatie Media Library is used to handle all image and video uploads across the application. The system supports:
- Image uploads with automatic conversions (thumbnails, optimized versions)
- Local video uploads (MP4, WebM, QuickTime)
- Real-time updates from Filament backend to frontend
- Seeding with media files

## Models with Media Library Integration

### 1. Article
- **Collection**: `featured_image`
- **Conversions**: 
  - `thumb` (400x225)
  - `hero` (1200x675 with responsive images)
- **Accessors**:
  - `featured_image_url` - Returns hero conversion URL
  - `featured_image_thumb_url` - Returns thumb conversion URL
- **Filament Form**: ArticleForm with SpatieMediaLibraryFileUpload

### 2. Gallery
- **Collection**: `cover`
- **Conversions**:
  - `optimized` (1200x800, WebP format, quality 85)
- **Accessor**:
  - `image_path` - Returns optimized conversion URL
- **Filament Form**: GalleryForm with SpatieMediaLibraryFileUpload

### 3. SocialLink
- **Collection**: `logo`
- **Conversions**: None (single file)
- **Accessor**:
  - `logo_url` - Returns logo URL
- **Filament Form**: SocialLinksForm with SpatieMediaLibraryFileUpload

### 4. Video
- **Collections**:
  - `clip_payload` - Video file (MP4, WebM, QuickTime)
  - `video_thumbnail` - Thumbnail/poster image
- **Conversions**:
  - `optimized` (800x450, WebP format, quality 82)
  - `thumb` (400x225)
- **Accessors**:
  - `video_url` - Returns video URL (YouTube or local)
  - `image_path` - Returns optimized thumbnail URL
  - `image_thumb_url` - Returns thumb thumbnail URL
- **Filament Form**: VideoForm with conditional video source (YouTube vs Local)

### 5. News
- **Collection**: `featured_image`
- **Conversions**:
  - `thumb` (400x225)
  - `hero` (1200x675 with responsive images)
- **Accessors**:
  - `featured_image_url` - Returns hero conversion URL
  - `featured_image_thumb_url` - Returns thumb conversion URL
- **Filament Form**: NewsForm with SpatieMediaLibraryFileUpload

### 6. BreakingNews
- **Collection**: `featured_image`
- **Conversions**:
  - `thumb` (400x225)
  - `hero` (1200x675 with responsive images)
- **Accessors**:
  - `image_url` - Returns hero conversion URL
- **Filament Form**: BreakingNewsForm with SpatieMediaLibraryFileUpload

### 7. Category
- **Collection**: `featured_image`
- **Conversions**:
  - `thumb` (400x225)
  - `hero` (1200x675 with responsive images)
- **Accessors**:
  - `featured_image_url` - Returns hero conversion URL
  - `featured_image_thumb_url` - Returns thumb conversion URL
- **Filament Form**: CategoryForm with SpatieMediaLibraryFileUpload

### 8. SiteSetting
- **Collection**: `site_logo`
- **Conversions**:
  - `optimized` (200x60)
- **Accessor**:
  - `logo_url` - Returns optimized logo URL
- **Filament Form**: SiteSettingForm with SpatieMediaLibraryFileUpload (visible only for 'site_header_logo' key)

## Frontend Components

All frontend components use the model accessors to display media without any changes to their logic:

- **picha-teaser-row**: Uses `$gallery->image_path`
- **hadithi-row**: Uses `$featuredItem->featured_image_url` and `$thumbItem->featured_image_thumb_url`
- **social-links**: Uses `$social['logo_url']` (populated from SocialLink model)
- **spoti-kenya-teaser-row**: Uses `$heroItem->featured_image_url` and `$thumbItem->featured_image_thumb_url`
- **spoti-majuu-teaser-row**: Uses `$featuredItem->featured_image_url` and `$thumbItem->featured_image_thumb_url`
- **three-column-teaser-row**: Uses `$article->featured_image_url`
- **magazine-home**: Uses `$article->featured_image_url` and `$article->featured_image_thumb_url`
- **site-header logo**: Uses `$this->siteLogoUrl` (from SiteHeader Livewire component)

## Real-time Updates

The system uses Laravel Reverb for real-time broadcasting:

- **BreakingNews**: Dispatches `BreakingNewsUpdated` event on create/update/delete
- **SocialLink**: Dispatches `SocialLinksUpdated` event on create/update/delete
- **SiteSetting**: Dispatches `SiteHeaderUpdated` event on create/update/delete

Frontend components listen to these events via Laravel Echo and refresh automatically.

## Seeding with Media Files

Media files can be seeded using the `addMedia()` method:

```php
$article->addMedia($path)
    ->preservingOriginal()
    ->toMediaCollection('featured_image');
```

Example seeders:
- `ArticleSeeder.php` - Seeds article images
- `SocialLinkSeeder.php` - Seeds social media logos

## Placeholder Images

Placeholders are stored in `public/images/placeholders/`:
- `article-default.jpg` - Default article image
- `breaking-news-default.jpg` - Default breaking news image
- `category-default.jpg` - Default category image
- `video-default.jpg` - Default video thumbnail

## File Upload Limits

- Images: 10MB max (configurable per form)
- Videos: 100MB max (VideoForm)
- Accepted image formats: JPG, PNG, WebP, GIF
- Accepted video formats: MP4, WebM, QuickTime

## Storage Configuration

Media files are stored using Laravel's filesystem configuration. By default, they use the `public` disk for easy access via the web.

## Conversions

All image conversions are processed non-queued (synchronously) for immediate availability. This ensures that images are available immediately after upload without requiring a queue worker.

## Accessing Media in Code

### Get media URL:
```php
$url = $model->getFirstMediaUrl('collection_name', 'conversion_name');
```

### Check if media exists:
```php
if ($model->hasMedia('collection_name')) {
    // Media exists
}
```

### Get all media:
```php
$mediaItems = $model->getMedia('collection_name');
```

### Add media programmatically:
```php
$model->addMedia($path)
    ->toMediaCollection('collection_name');
```

### Delete media:
```php
$model->clearMediaCollection('collection_name');
```

## Troubleshooting

### Images not displaying:
1. Check that the media collection name matches between model and form
2. Verify the conversion name in accessor matches the conversion definition
3. Ensure the `public` disk is properly configured in `config/filesystems.php`

### Videos not playing:
1. Verify the video format is accepted (MP4, WebM, QuickTime)
2. Check that the video file size is within limits (100MB)
3. Ensure the MIME type is correctly detected

### Real-time updates not working:
1. Verify Laravel Reverb is running
2. Check that the event is being dispatched in the model's `booted()` method
3. Ensure the frontend component is listening to the correct channel and event

## Future Enhancements

Consider implementing:
- Queue-based conversions for better performance with large files
- CDN integration for media delivery
- Image optimization service integration
- Video transcoding for multiple formats
- Media library cleanup job for old/unused files
