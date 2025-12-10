# Forgot Password Implementation - Username-Based with Security Questions

## Overview
Implemented a secure password reset system using **username and security questions** instead of email, since the database has no email field.

## Changes Made

### 1. Database Schema (`schema.sql` & `migration_add_security_fields.sql`)
- Added `security_question VARCHAR(255)` to users table
- Added `security_answer VARCHAR(255)` to users table (stored as hashed value)
- Created migration file for existing databases

### 2. Registration (`signup.php`)
- Added security question dropdown with 5 common questions:
  - What is your favorite color?
  - What city were you born in?
  - What is your pet's name?
  - What is your mother's maiden name?
  - What was your first school's name?
- Added security answer text input
- Both fields are required during signup

### 3. Authentication Library (`lib/auth.php`)
- Updated `register_user()` function to accept security question/answer parameters
- Security answer is hashed with `password_hash()` before storage (case-insensitive)
- Made parameters optional for backward compatibility

### 4. Forgot Password Flow (`forgot_password.php`)
**Step 1: Username Entry**
- User enters their username
- System checks if username exists and has security question set
- Stores user info in session and proceeds to step 2

**Step 2: Security Question**
- Displays the user's security question
- User enters their answer
- System verifies answer using `password_verify()`
- On success, redirects to reset password page
- Includes "Start over" button to restart process

### 5. Password Reset (`reset_password.php`)
- Completely rewritten from token-based to session-based
- Checks `$_SESSION['reset_user_id']` for authentication
- User enters new password with confirmation
- Includes password toggle visibility (👀 icon)
- Clears reset session variables after successful reset
- Redirects to login page with success message

## Security Features
- Security answers are hashed (never stored in plaintext)
- Answers are case-insensitive (converted to lowercase before hashing)
- Session-based verification prevents unauthorized access to reset page
- Password requirements enforced (min 6 characters)
- Session cleared after successful reset

## Migration Instructions

### For New Installations:
1. Run `schema.sql` - already includes security fields

### For Existing Databases:
1. Run `migration_add_security_fields.sql` in phpMyAdmin
2. Existing users won't have security questions set
3. They'll need to contact admin or re-register

### Testing the Flow:
1. **Register new user**: Visit `signup.php`, fill all fields including security question
2. **Forgot password**: Visit `forgot_password.php`, enter username
3. **Answer question**: System shows your security question, answer it
4. **Reset password**: Enter and confirm new password
5. **Login**: Use new password at `index.php`

## Files Modified
- ✅ `schema.sql` - Added security fields to users table
- ✅ `signup.php` - Added security question/answer fields
- ✅ `lib/auth.php` - Updated register_user() function
- ✅ `forgot_password.php` - Complete rewrite for username-based flow
- ✅ `reset_password.php` - Changed from token to session-based

## Files Created
- ✅ `migration_add_security_fields.sql` - Migration for existing databases

## Notes
- No email functionality required
- Works entirely with username-based authentication
- Arctic theme styling maintained throughout
- Glass morphism design consistent with app theme
- Password visibility toggle on all password fields
