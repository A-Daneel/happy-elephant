#!/bin/bash
# Check if currently in git repository
if [ -d ".git" ]; then
    echo Please move this script outside of the repository before running it!
    exit 1
fi

# Delete leftover files
echo Removing files from earlier runs, please wait...
rm -rf elephant
rm -rf public_html

# Download the contents of the current git repo, and delete git files
git clone --depth=1 https://github.com/A-Daneel/happy-elephant elephant
rm -rf elephant/.git

# Move elephant/public to public_html/elephant
egrep -lRZ 'public/' elephant | xargs -0 -l sed -i -e 's/public\//..\/public_html\/elephant\//g'
sed -i -e 's/\/config\/bootstrap.php/\/..\/elephant\/config\/bootstrap.php/g' elephant/public/index.php
sed -i -e 's/\"extra\": {/\"extra\": {\n        \"public-dir\": \"..\/public_html\/elephant\",/g' elephant/composer.json
mkdir public_html
mv elephant/public public_html/elephant

# Download/build dependencies
cd elephant
export APP_DEBUG=0 APP_ENV=prod
composer install --no-dev --optimize-autoloader
yarn install
yarn build
cd ../

# Remove files redundant for operation 
echo Removing files redundant for operation, please wait...
rm elephant/* 2> /dev/null
rm -rf elephant/.github
rm -rf elephant/.hooks
rm -rf elephant/assets
rm -rf elephant/bin
rm -rf elephant/node_modules
rm -rf elephant/var

# Create environment variable file
cat > elephant/.env.local.php << EOL
<?php

return array (
    'APP_DEBUG' => '0',
    'APP_ENV' => 'prod',
    'APP_SECRET' => '6badc0fca270ab84a00a67226f9e2554',
    'USERPROVIDER_KEY' => 'ThisIsNotSoSecret',
    'DATABASE_URL' => 'mysql://db_user:db_pass@127.0.0.1:3306/db',
    'MAILER_URL' => 'null://localhost',
    'DEFAULT_FROM' => 'foo@bar.com',
);
EOL
echo Please edit '.env.local.php' and push the code to your server
