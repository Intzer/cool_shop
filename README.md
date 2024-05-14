Setup:
sail up -d
sail artisan storage:linj
sail artisan composer install
sail artisan npm install
sail artisan migrate

To start:
sail up -d
sail artisan npm run dev
