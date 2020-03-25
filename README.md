# brain-train-backend

# Installation

####  1. First, clone this repository:

```bash
$ git clone https://github.com/RazaChohan/brain-train-backend.git
```

####  2. Next, kindly add following entry in your `/etc/hosts` file:

```bash
127.0.0.1 api.braintraining.local
```

- Create docker containers:

```bash
$ docker-compose up -d
```

#### 3. Confirm three running containers for php, nginx, & mysql:

```bash
$ docker-compose ps 
```

#### 4. Install composer packages:

```bash
$ docker-compose run php composer install 
```
#### 5. Create Database schema:

```bash
$ docker-compose run php php artisan migrate 
```

#### 6. Load data is Database:

```bash
$ docker-compose run php php artisan db:seed
```

#### 7. Run test cases:

```bash
$ docker-compose run php vendor/bin/phpunit
```

#### 8. Generte token:
```bash
 $ curl -X POST -H "Content-Type: application/json" http://api.braintraining.local/auth/login -d '{"username":"newuser","password":"brain_training_123"}'
```

#### 9. Get history of scores call:
```bash
 $ curl -X GET "http://api.braintraining.local/score?token={token}"
```

#### 10. Get history of scores with latest session categories call:
```bash
  $ curl -X GET "http://api.braintraining.local/score?token={token}&getLastSessionCategories=true"
```

#### Data Schema:
- The following image shows the Database schema used in this solution. Score table is removed and denormalized into session table.

![schema](https://raw.githubusercontent.com/RazaChohan/brain-train-backend/master/schema.png)

#### Application logs can be found on following locations:
```bash
  logs/nginx
  application/storage/logs
```



