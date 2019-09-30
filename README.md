## Durham Exercise

* Migrations and seeder have been created, creates 2 admin users and 100 standard users
* All passwords are seeded to be '123456'
* Admin users are 'admin1@test.com' and 'admin2@test.com'
* Runs from an SQLLite Database file
* Served using php artisan serve
* Tested with Postman on Mac 

To setup:
```
composer install
copy .env.example to .env and edit DB path where necessary
php artisan migrate:refresh --seed
php artisan serve
php artisan passport:client --password
```

Note down the Client ID and Client Secret

To auth:
```
http://127.0.0.1:8000/oauth/token

[
username => admin1@test.com (or other user)
password => 123456
grant_type => password
client_id => <client_id>
client_secret => <client_secret>
]
```

To retrieve groups:
```
http://127.0.0.1:8000/api/v1/groups

[
Authorization => Bearer <client_secret>
Accept => application/json
]
```

To retrieve users:
```
http://127.0.0.1:8000/api/v1/users

[
Authorization => Bearer <client_secret>
Accept => application/json
]
```