# Login
  - URL: `/api/login`
  
  - Method: `POST`
  
  - Headers: No
  
  - URL Param: 
  
    + Required: No
    
    + Optional: No
    
    + Data Param: 
      ```json
        {
          "username": "username", 
          "password": "password"
        }
      ```
    
  - Success Response:
    
    + Code: 200
    
    + Content: 
       
      ```json
        {
            "access_token": "eyJ0eAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTU1NDUzNTU4NywiZXhwIjoxNTU0NTM5MTg3LCJuYmYiOjE1NTQ1MzU1ODcsImp0aSI6Ikkzakx6TlZiWEdlUHdNenAiLCJzdWIiOiJhZG1pbjEyMyIsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.D2nvYuRcIj2p7ABxOTekvRWqIyEex-MsRfT-8YxkqlI",
            "token_type": "bearer",
            "expires_in": 3600,
            "name": "tan hau"
        }
      ```
  - Error Response:
    
    + Code: 401 UNAUTHORIZED 
    
    + Content: `Username or password dosen't exist`
    
  - Sample Call:
     ```js
        $.ajax({
            url: '/login',
            method: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            headers:{},
            data:{
                // Your data
            },
            success:function(data) {
                // data is content of success response
            },
            error:function(err) {
                // err is content of Error response
            }
        });
    ```   
    
  - Notice: Phương thức này dùng để đăng nhập và nhận về Access Token. Ở đây chúng tôi sử dụng JWT
  
#Register

  - URL: `/api/register`
  
  - Method: `POST`
  
  - Headers: No
  
  - URL Param: 
  
    + Required: No
    
    + Optional: No
    
    + Data Param:
      
      ```json
        {
          "username": "username",
          "password": "password",
          "email": "email",
          "ip_client": "ip_client",
          "role" : 0,
          "name": "name",
          "score": 0
        }
      ```
    
  - Success Response:
    
    + Code: 200
    
    + Content: 
       
      ```json
        {
            "access_token": "eyJ0eAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTU1NDUzNTU4NywiZXhwIjoxNTU0NTM5MTg3LCJuYmYiOjE1NTQ1MzU1ODcsImp0aSI6Ikkzakx6TlZiWEdlUHdNenAiLCJzdWIiOiJhZG1pbjEyMyIsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.D2nvYuRcIj2p7ABxOTekvRWqIyEex-MsRfT-8YxkqlI",
            "token_type": "bearer",
            "expires_in": 3600,
            "name": "tan hau"
        }
      ```
  - Error Response:
    
    + Code: 400 
    
    + Content: `Username already`
    
  - Sample Call:
     ```js
        $.ajax({
            url: '/register',
            method: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            headers:{},
            data:{
                // Your data
            },
            success:function(data) {
                // data is content of success response
            },
            error:function(err) {
                // err is content of Error response
            }
        });
    ```   
    
  - Notice: 
  
    + Score: 
      
      - Điểm của người dùng có Role là 1. 
      - Luôn luôn là null với Role là 2 và 3
      - Điểm sẽ là điểm chung của điểm Examination và điểm Exercise
    
    + Role:
      
      - 1: Người dùng. Chỉ được sử dụng các dịch vụ. Mặc định tất cả các Account được tạo ra sẽ có role là 1
      
      - 2: Người dùng là teacher. Có khả năng quản lý tất cả quyền 1 hoặc nhiều team. Họ phải đăng kí với Administrator
      
      - 3: Người dùng là Administrator. Có mọi quyền. Và duy nhất.
      
  
# Logout
  - URL: `/api/logout`
  
  - Method: `POST`
  
  - Headers: No
  
  - URL Param: 
  
    + Required: No
    
    + Optional: No
    
    + Data Param: No
    
  - Success Response:
    
    + Code: 200
    
    + Content: 
       
      ```json
        {
            "message" : "Successfully logged out"
        }
      ```
  - Error Response:
    
    + Code: 401 UNAUTHORIZED 
    
  - Sample Call
    
  - Notice: 
  
  
  
# Me
  - URL: `/api/me`
  
  - Method: `POST`
  
  - Headers: 
    
    ```json
        {
          "Authorization": "Bearer your_token"
        }
    ```
  
  - URL Param: 
  
    + Required: No
    
    + Optional: No
    
    + Data Param: No
    
  - Success Response:
    
    + Code: 200
    
    + Content: Information of me. No include password
  - Error Response:
    
    + Code: 401 UNAUTHORIZED 
    
    + Content: `Login first`
    
  - Sample Call:
     ```js
        $.ajax({
            url: '/me',
            method: 'POST',
            headers:{
                // authorize
            },
            success:function(data) {
                // data is content of success response
            },
            error:function(err) {
                // err is content of Error response
            }
        });
    ```   
    
  - Notice: Phương thức này dùng để đăng nhập và nhận về Access Token. Ở đây chúng tôi sử dụng JWT
    
  
  
# Change password
  - URL: `/api/changepass`
  
  - Method: `POST`
  
  - Headers: 
  
    ```json
         {
            "Authorization": "Bearer your_token"
         }
    ```
  
  - URL Param: 
  
    + Required: No
    
    + Optional: No
    
    + Data Param: 
      ```json
        {
          "username": "username", 
          "password": "password",
          "new_password": "new_password"
        }
      ```
    
  - Success Response:
    
    + Code: 200
    
    + Content: `Success`
    
  - Error Response:
    
    + Code: 401 UNAUTHORIZED 
    
      - Content: `Error`
    
    + Code: 400 Bad Request
    
      - Content: `ErrorOldPass`
    
  - Sample Call:
     ```js
        $.ajax({
            url: '/changepass',
            method: 'POST',
            headers:{
                // your Auth
            },
            data:{
                // Your data
            },
            success:function(data) {
                // data is content of success response
            },
            error:function(err) {
                // err is content of Error response
            }
        });
    ```   
    
  - Notice: Phương thức này dùng để đăng nhập và nhận về Access Token. Ở đây chúng tôi sử dụng JWT
    
  
  
# sendPasswordResetLink
  - URL: `/api/sendPasswordResetLink`
  
  - Method: `POST`
  
  - Headers: No
  
  - URL Param: 
  
    + Required: No
    
    + Optional: No
    
    + Data Param: 
      ```json
        {
          "email": "username"
        }
      ```
    
  - Success Response:
    
    + Code: 200
    
    + Content: `Reset Email is send successfully, please check your inbox.`
    
  - Error Response:
    
    + Code: 400 Bad Request 
    
      - Content: `Email does't found on our database`

  - Sample Call:
     ```js
        $.ajax({
            url: '/api/sendPasswordResetLink',
            method: 'POST',
            data:{
                // Your data
            },
            success:function(data) {
                // data is content of success response
            },
            error:function(err) {
                // err is content of Error response
            }
        });
    ```   
    
  - Notice: Phương thức này dùng để đăng nhập và nhận về Access Token. Ở đây chúng tôi sử dụng JWT
     
  
  
  
# resetPassword
  - URL: `/api/resetPassword`
  
  - Method: `POST`
  
  - Headers: No
  
  - URL Param: 
  
    + Required: Password confirmed
    
    + Optional: No
    
    + Data Param: 
      ```json
        {
          "email": "email",
          "password": "password"
        }
      ```
    
  - Success Response:
    
    + Code: 201 Created
    
    + Content: `Password Successfully Changed`
    
  - Error Response:
    
    + Code: 422 HTTP UNPROCESSABLE ENTITY
    
      - Content: `Token or Email is incorrect`

  - Sample Call:
     ```js
        $.ajax({
            url: '/api/sendPasswordResetLink',
            method: 'POST',
            data:{
                // Your data
            },
            success:function(data) {
                // data is content of success response
            },
            error:function(err) {
                // err is content of Error response
            }
        });
    ```   
    
  - Notice: Phương thức này dùng để đăng nhập và nhận về Access Token. Ở đây chúng tôi sử dụng JWT
     
  
  
  
  
  