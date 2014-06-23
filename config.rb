require "breakpoint"
require "susy"

# Custom Variables
theme_directory = 'content/themes/local-whistler'

http_path = "/"
sass_dir = theme_directory + '/app/styles'
css_dir = theme_directory + '/.tmp/styles'
generatedImagesDir = theme_directory + "/.tmp/images/generated"
images_dir = theme_directory + "/app/images"
javascriptsDir = theme_directory + "/app/scripts"
fonts_dir = theme_directory + "/app/fonts"
importPath = theme_directory + "/app/bower_components"
httpImagesPath = theme_directory + "/assets/images"
httpGeneratedImagesPath = theme_directory + "/assets/images/generated"
httpFontsPath = theme_directory + "/assets/fonts"
relativeAssets = false
assetCacheBuster = false
bundleExec = true
debugInfo = false
