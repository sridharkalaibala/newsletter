# Subscribers API

Online Demo: http://ec2-52-14-247-72.us-east-2.compute.amazonaws.com/newsletter/public/index.php/api/subscribers

Please follow the steps to run in local

##Prerequisites:

PHP Composer  
Mysql Database


##Steps:

    Step1:  Go to project root folder and run `composer install`
    
    Step2:  Copy or rename the file .env.example to .env
    
    Step2:  Enter your mysql db connection details in .env File

Example: 
```DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=newsletter
DB_USERNAME=root
DB_PASSWORD=
```
Step3:  Run the following command one by one. 

```
php artisan migrate
php artisan db:seed
php artisan serve
```

after executing `php artisan serve`  you can able to url like `http://127.0.0.1:8080/`

Now you can able to access REST API End points. 

Example: `http://127.0.0.1:8080/api/subscribers`




#Created Endpoints:

* **URL**: `/api/subscribers/{id}`   	Type: [**GET**]

    Example:
    `http://ec2-52-14-247-72.us-east-2.compute.amazonaws.com/newsletter/public/index.php/api/subscribers/1`


* **URL**:`/api/subscribers`   	Type: [**GET**]

    **Params:**
    
     offset, limit  `?offset=0&limit=10` 
     
    **Example:**
    `http://ec2-52-14-247-72.us-east-2.compute.amazonaws.com/newsletter/public/index.php/api/subscribers?offset=0&limit=5`
    


* **URL**:`/api/subscribers`   	Type: [**POST**]

    **Params / body:**
    
    ```json
    {
        "name" : "Sridhar Bala",
        "email": "xxxyyyzzz@gmail.com",
        "state": "bounced",
        "fields": [
            {
                "title": "vel",
                "value": "1994-12-31",
                "type": "date"
            },
            {
                "title": "quos",
                "value": "occaecati",
                "type": "string"
            }
        ]
    }
    ```
    
    **Example:**
    
    `POST above body to http://ec2-52-14-247-72.us-east-2.compute.amazonaws.com/newsletter/public/index.php/api/subscribers`
    


* **URL**:`/api/subscribers/{id}`   Type: [**PUT**]

    **Params / body:**
    
    ```json
    {
        "name" : "Arul John",
        "state": "bounced",
        "fields": [
            {
                "title": "xyz",
                "value": "1994-12-31",
                "type": "date"
            },
            {
                "title": "next",
                "value": "occaecati",
                "type": "string"
            }
        ]
    }
    ```
    
    **Example:**
    
    `PUT above body to http://ec2-52-14-247-72.us-east-2.compute.amazonaws.com/newsletter/public/index.php/api/subscribers/1`


* **URL**:`/api/subscribers/{id}`   Type: [**DELETE**]

    **Example:**
    
    `DELETE request to http://ec2-52-14-247-72.us-east-2.compute.amazonaws.com/newsletter/public/index.php/api/subscribers/1`

#To run Test

    `composer test` // if its windows vendor/bin/phpunit