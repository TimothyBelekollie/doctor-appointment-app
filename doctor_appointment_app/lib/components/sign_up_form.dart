import 'package:doctor_appointment_app/components/button.dart';
import 'package:doctor_appointment_app/main.dart';
import 'package:doctor_appointment_app/models/auth_model.dart';
import 'package:doctor_appointment_app/providers/dio_provider.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../utils/config.dart';

class SignUpForm extends StatefulWidget {
  SignUpForm({Key? key}) : super(key: key);

  @override
  State<SignUpForm> createState() => _SignUpFormState();
}

class _SignUpFormState extends State<SignUpForm> {
  final _formKey = GlobalKey<FormState>();
  final _nameController = TextEditingController();
  final _emailController = TextEditingController();
  final _passController = TextEditingController();
  bool obscurePass = true;

  // Regular expression for email validation
  RegExp emailRegex = RegExp(r'^[\w-]+(\.[\w-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$');

  // Regular expression for password validation
  RegExp passwordRegex = RegExp(r'^(?=.*?[A-Za-z])(?=.*?[0-9]).{8,}$');

  @override
  Widget build(BuildContext context) {
    return Form(
      key: _formKey,
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        children: <Widget>[
          TextFormField(
            controller: _nameController,
            keyboardType: TextInputType.text,
            cursorColor: Config.primaryColor,
            decoration: const InputDecoration(
              hintText: 'Username',
              labelText: 'Username',
              alignLabelWithHint: true,
              prefixIcon: Icon(Icons.person_outlined),
              prefixIconColor: Config.primaryColor,
            ),
            validator: (value) {
              if (value!.isEmpty) {
                return 'Please enter your username';
              }
              return null;
            },
          ),
          Config.spaceSmall,
          TextFormField(
            controller: _emailController,
            keyboardType: TextInputType.emailAddress,
            cursorColor: Config.primaryColor,
            decoration: const InputDecoration(
              hintText: 'Email Address',
              labelText: 'Email',
              alignLabelWithHint: true,
              prefixIcon: Icon(Icons.email_outlined),
              prefixIconColor: Config.primaryColor,
            ),
            validator: (value) {
              if (value!.isEmpty) {
                return 'Please enter your email';
              }
              if (!emailRegex.hasMatch(value)) {
                return 'Please enter a valid email address';
              }
              return null;
            },
          ),
          Config.spaceSmall,
          TextFormField(
            controller: _passController,
            keyboardType: TextInputType.visiblePassword,
            cursorColor: Config.primaryColor,
            obscureText: obscurePass,
            decoration: InputDecoration(
              hintText: 'Password',
              labelText: 'Password',
              alignLabelWithHint: true,
              prefixIcon: const Icon(Icons.lock_outline),
              prefixIconColor: Config.primaryColor,
              suffixIcon: IconButton(
                onPressed: () {
                  setState(() {
                    obscurePass = !obscurePass;
                  });
                },
                icon: obscurePass
                    ? const Icon(
                        Icons.visibility_off_outlined,
                        color: Colors.black38,
                      )
                    : const Icon(
                        Icons.visibility_outlined,
                        color: Config.primaryColor,
                      ),
              ),
            ),
            validator: (value) {
              if (value!.isEmpty) {
                return 'Please enter your password';
              }
              if (!passwordRegex.hasMatch(value)) {
                return 'Password must be at least 8 characters long and contain at least one letter and one number';
              }
              return null;
            },
          ),
          Config.spaceSmall,
          Consumer<AuthModel>(
            builder: (context, auth, child) {
              return Button(
                width: double.infinity,
                title: 'Sign Up',
                onPressed: () async {
                  if (_formKey.currentState!.validate()) {
                    // Username, email, and password validation passed, proceed with sign up

                    final userRegistration = await DioProvider().registerUser(
                      _nameController.text,
                      _emailController.text,
                      _passController.text,
                    );

                    // If registration is successful, proceed with login
                    if (userRegistration) {
                      final token = await DioProvider().getToken(
                        _emailController.text,
                        _passController.text,
                      );

                      if (token) {
                        auth.loginSuccess({}, {}); // Update login status
                        // Redirect to main page
                        MyApp.navigatorKey.currentState!.pushNamed('main');
                      }
                    } else {
                      print('Registration not successful');
                    }
                  }
                },
                disable: false,
              );
            },
          ),
        ],
      ),
    );
  }
}
