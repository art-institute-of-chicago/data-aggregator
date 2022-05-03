import imagehash
import sys
from PIL import Image

print(str(imagehash.phash(Image.open(sys.argv[1]))))
