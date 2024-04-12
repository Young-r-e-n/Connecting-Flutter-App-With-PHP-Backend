# Flutter-PHP-API-Tutorial

Welcome to the Flutter-PHP-API-Tutorial repository! This project aims to provide a comprehensive guide on how to connect a Flutter sign-up and login page with a PHP backend via an API. Whether you're a beginner looking to learn about Flutter, PHP, or REST APIs, or an experienced developer looking to integrate a Flutter app with a PHP backend, this tutorial is for you.

## Table of Contents

- [Getting Started](#getting-started)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Getting Started

This section will guide you through setting up your development environment and getting the project up and running on your local machine.

### Prerequisites

Before you begin, ensure you have the following installed on your system:

- Flutter SDK
- PHP
- A code editor (e.g., Visual Studio Code)

### Installation

1. Clone the repository:

2. Navigate to the project directory:

3. Install Flutter dependencies:


Creating a login and signup page in Flutter that communicates with a PHP backend via an API involves several steps. Follow these steps to get started.

### Step 1: Setting Up the Flutter Project

First, ensure you have Flutter installed on your system. If not, follow the Flutter installation guide on the official Flutter website.

1. Create a new Flutter project:
   
   flutter create flutter_login_signup
   
2. Navigate to the project directory:
   
   cd flutter_login_signup
   

### Step 2: Creating the Login Page

1. Create a new Dart file for the login page:
   
   touch lib/login_page.dart
   

2. Implement the login page:
   dart
   import 'package:flutter/material.dart';
   import 'dart:convert';
   import 'package:http/http.dart' as http;

   class LoginPage extends StatefulWidget {
     @override
     _LoginPageState createState() => _LoginPageState();
   }

   class _LoginPageState extends State<LoginPage> {
     final TextEditingController _emailController = TextEditingController();
     final TextEditingController _passwordController = TextEditingController();

     Future<void> _loginUser() async {
       final String email = _emailController.text;
       final String password = _passwordController.text;

       final response = await http.post(
         Uri.parse('http://your-api-url.com/login.php'),
         body: {
           'email': email,
           'password': password,
         },
       );

       if (response.statusCode == 200) {
         final responseData = json.decode(response.body);
         if (responseData['success']) {
           // Navigate to the next page or show a success message
         } else {
           // Show an error message
         }
       } else {
         // Show an error message
       }
     }

     @override
     Widget build(BuildContext context) {
       return Scaffold(
         appBar: AppBar(
           title: Text('Login'),
         ),
         body: Padding(
           padding: const EdgeInsets.all(16.0),
           child: Column(
             children: <Widget>[
               TextField(
                 controller: _emailController,
                 decoration: InputDecoration(labelText: 'Email'),
               ),
               TextField(
                 controller: _passwordController,
                 decoration: InputDecoration(labelText: 'Password'),
                 obscureText: true,
               ),
               ElevatedButton(
                 onPressed: _loginUser,
                 child: Text('Login'),
               ),
             ],
           ),
         ),
       );
     }
   }
   

### Step 3: Creating the Signup Page

1. Create a new Dart file for the signup page:
   
   touch lib/signup_page.dart
   

2. Implement the signup page:
   dart
   import 'package:flutter/material.dart';
   import 'dart:convert';
   import 'package:http/http.dart' as http;

   class SignupPage extends StatefulWidget {
     @override
     _SignupPageState createState() => _SignupPageState();
   }

   class _SignupPageState extends State<SignupPage> {
     final TextEditingController _emailController = TextEditingController();
     final TextEditingController _passwordController = TextEditingController();

     Future<void> _signupUser() async {
       final String email = _emailController.text;
       final String password = _passwordController.text;

       final response = await http.post(
         Uri.parse('http://your-api-url.com/signup.php'),
         body: {
           'email': email,
           'password': password,
         },
       );

       if (response.statusCode == 200) {
         final responseData = json.decode(response.body);
         if (responseData['success']) {
           // Navigate to the login page or show a success message
         } else {
           // Show an error message
         }
       } else {
         // Show an error message
       }
     }

     @override
     Widget build(BuildContext context) {
       return Scaffold(
         appBar: AppBar(
           title: Text('Signup'),
         ),
         body: Padding(
           padding: const EdgeInsets.all(16.0),
           child: Column(
             children: <Widget>[
               TextField(
                 controller: _emailController,
                 decoration: InputDecoration(labelText: 'Email'),
               ),
               TextField(
                 controller: _passwordController,
                 decoration: InputDecoration(labelText: 'Password'),
                 obscureText: true,
               ),
               ElevatedButton(
                 onPressed: _signupUser,
                 child: Text('Signup'),
               ),
             ],
           ),
         ),
       );
     }
   }
   

### Step 4: Setting Up the PHP Backend

You'll need to create two PHP scripts: `login.php` and `signup.php`. These scripts will handle the login and signup requests from the Flutter app. Ensure your PHP server is running and accessible.

1. Create `login.php`:
   php
   <?php
   // Include your database connection file
   require_once 'db_config.php';

   // Get the input data
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Query the database
   $query = "SELECT * FROM users WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("ss", $email, $password);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($result->num_rows > 0) {
     echo json_encode(['success' => true]);
   } else {
     echo json_encode(['success' => false]);
   }

   $stmt->close();
   $conn->close();
   ?>
   

2. Create `signup.php`:
   php
   <?php
   // Include your database connection file
   require_once 'db_config.php';

   // Get the input data
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Insert the new user into the database
   $query = "INSERT INTO users (email, password) VALUES (?, ?)";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("ss", $email, $password);
   $stmt->execute();

   if ($stmt->affected_rows > 0) {
     echo json_encode(['success' => true]);
   } else {
     echo json_encode(['success' => false]);
   }

   $stmt->close();
   $conn->close();
   ?>
   

### Step 5: Running the Flutter App

1. Run the Flutter app:
   
   flutter run
   

This setup provides a basic example of how to create a login and signup page in Flutter that communicates with a PHP backend via an API. Remember to replace `'http://your-api-url.com/login.php'` and `'http://your-api-url.com/signup.php'` with your actual API URLs. Also, ensure your PHP backend is properly set up to handle these requests, including proper validation and security measures.

#   C o n n e c t i n g - F l u t t e r - A p p - W i t h - P H P - B a c k e n d 
 
 