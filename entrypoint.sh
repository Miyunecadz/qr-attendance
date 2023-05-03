#!/bin/sh
set -euC

# Create .env
echo ----- Copy .env file
cp .env.example .env

# update .env
echo ----- Update .env file
sed -i "s/APP_NAME=.*/APP_NAME=${APP_NAME}/g" .env
sed -i "s/APP_ENV=.*/APP_ENV=${APP_ENV}/g" .env
sed -i "s/APP_DEBUG=.*/APP_DEBUG=false/g" .env
sed -i "s@APP_URL=.*@APP_URL=${APP_URL}@g" .env
sed -i "s@APP_URL_FE=.*@APP_URL_FE=${APP_URL_FE}@g" .env
sed -i "s/LOG_CHANNEL=.*/LOG_CHANNEL=stderr/g" .env
sed -i "s/LOG_LEVEL=.*/LOG_LEVEL=${LOG_LEVEL}/g" .env
sed -i "s@APP_KEY=.*@APP_KEY=${APP_KEY}@g" .env
sed -i "s@DB_HOST=.*@DB_HOST=${DB_HOST}@g" .env
sed -i "s/DB_PORT=.*/DB_PORT=${DB_PORT}/g" .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/g" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/g" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/g" .env
sed -i "s/MAIL_MAILER=.*/MAIL_MAILER=${MAIL_MAILER}/g" .env
sed -i "s@MAIL_HOST=.*@MAIL_HOST=${MAIL_HOST}@g" .env
sed -i "s/MAIL_PORT=.*/MAIL_PORT=${MAIL_PORT}/g" .env
sed -i "s/MAIL_FROM_ADDRESS=.*/MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS}/g" .env
sed -i "s/MAIL_FROM_NAME=.*/MAIL_FROM_NAME=${MAIL_FROM_NAME}/g" .env
sed -i "s/JWT_ALGO=.*/JWT_ALGO=${JWT_ALGO}/g" .env
sed -i "s/JWT_SECRET=.*/JWT_SECRET=${JWT_SECRET}/g" .env
sed -i "s@L5_SWAGGER_CONST_HOST=.*@L5_SWAGGER_CONST_HOST=${L5_SWAGGER_CONST_HOST}@g" .env
sed -i "s/L5_SWAGGER_GENERATE_ALWAYS=.*/L5_SWAGGER_GENERATE_ALWAYS=${L5_SWAGGER_GENERATE_ALWAYS}/g" .env
sed -i "s/L5_SWAGGER_UI_PERSIST_AUTHORIZATION=.*/L5_SWAGGER_UI_PERSIST_AUTHORIZATION=${L5_SWAGGER_UI_PERSIST_AUTHORIZATION}/g" .env
sed -i "s@SHIFTER_API_URL=.*@SHIFTER_API_URL=${SHIFTER_API_URL}@g" .env
sed -i "s@VITE_SHIFTER_ID=.*@VITE_SHIFTER_ID=${VITE_SHIFTER_ID}@g" .env
sed -i "s@VITE_SHIFTER_USERNAME=.*@VITE_SHIFTER_USERNAME=${VITE_SHIFTER_USERNAME}@g" .env
sed -i "s@VITE_SHIFTER_PASSWORD=.*@VITE_SHIFTER_PASSWORD=${VITE_SHIFTER_PASSWORD}@g" .env


# Cache config
echo ----- Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migration
echo ----- Migration
php artisan migrate --isolated --force
php artisan db:seed --force

# Swagger
echo ----- Swagger
if [ "$APP_ENV" != "production" ]; then
    # Ignore production / staging
    php artisan l5-swagger:generate
fi

# Run apache
echo ----- Run apache
apache2-foreground
