import imagehash
import sys
from PIL import Image

print(str(imagehash.average_hash(Image.open(sys.argv[1]))))
