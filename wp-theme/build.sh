#!/usr/bin/env sh
# Builds installable zips into wp-theme/dist/:
#   sofreh.zip                 -> Appearance → Themes → Add New → Upload
#   sofreh-phone-accounts.zip  -> Plugins → Add New → Upload
set -eu
cd "$(dirname "$0")"
rm -rf dist && mkdir -p dist
zip -qr dist/sofreh.zip sofreh -x '*.DS_Store'
zip -qr dist/sofreh-phone-accounts.zip sofreh-phone-accounts -x '*.DS_Store'
ls -l dist
