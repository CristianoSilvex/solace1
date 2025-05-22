import os
from PIL import Image

# Directory containing images
IMAGE_DIR = 'public/midia/'
TARGET_SIZE = (800, 800)

# Supported image extensions
EXTENSIONS = ('.jpg', '.jpeg', '.png', '.webp')

def resize_and_pad(image_path, size, background_color=(255, 255, 255)):
    with Image.open(image_path) as im:
        im = im.convert('RGBA')
        # Calculate the new size preserving aspect ratio
        ratio = min(size[0] / im.width, size[1] / im.height)
        new_size = (int(im.width * ratio), int(im.height * ratio))
        im_resized = im.resize(new_size, Image.LANCZOS)

        # Create a new image with white background
        background = Image.new('RGBA', size, background_color + (255,))
        offset = ((size[0] - new_size[0]) // 2, (size[1] - new_size[1]) // 2)
        background.paste(im_resized, offset, im_resized if im_resized.mode == 'RGBA' else None)
        # Convert to RGB (no alpha, white background)
        return background.convert('RGB')

def process_images():
    for filename in os.listdir(IMAGE_DIR):
        if filename.lower().endswith(EXTENSIONS):
            path = os.path.join(IMAGE_DIR, filename)
            print(f'Resizing {filename}...')
            new_img = resize_and_pad(path, TARGET_SIZE)
            new_img.save(path, quality=95)
    print('All images resized and backgrounds set to white!')

if __name__ == '__main__':
    process_images() 