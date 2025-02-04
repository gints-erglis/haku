#!/bin/bash

old_theme=$(basename "$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)")
echo "This theme name is $old_theme"

# Prompt user for new theme name
echo "Enter new theme name (e.g. newtheme):"
read new_theme

path="../.."
# Define the theme directory path
theme_dir="$path/$old_theme"



# Check if theme folder exists
if [ ! -d "$theme_dir" ]; then
  echo "Theme folder '$theme_dir' not found. Please check the theme directory."
  exit 1
fi

# Rename the theme folder
rsync -av --exclude='node_modules' --exclude='dist' "$path/$old_theme/" "$path/$new_theme/"
echo "Theme folder renamed from '$old_theme' to '$new_theme'"

# Rename theme.info.yml file
mv "$path/$new_theme/$old_theme.info.yml" "$path/$new_theme/$new_theme.info.yml"
echo "Renamed $old_theme.info.yml to $new_theme.info.yml"

# Rename theme.libraries.yml file
mv "$path/$new_theme/$old_theme.libraries.yml" "$path/$new_theme/$new_theme.libraries.yml"
echo "Renamed $old_theme.libraries.yml to $new_theme.libraries.yml"

# Rename theme file
mv "$path/$new_theme/$old_theme.theme" "$path/$new_theme/$new_theme.theme"
echo "Renamed $old_theme.theme to $new_theme.theme"

# Update references in all files inside the theme folder
LC_ALL=C find "$path/$new_theme" \
  -type d \( -name "node_modules" -o -name "dist" -o -name "scripts" \) -prune -o \
  -type f -exec sed -i "" "s/$old_theme/$new_theme/g" {} \;
echo "Replaced all instances of '$old_theme' with '$new_theme' in theme files"

echo "Theme rename process completed!"
