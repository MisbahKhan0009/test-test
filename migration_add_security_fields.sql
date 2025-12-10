-- Migration to add security question fields to users table
-- Run this in phpMyAdmin after creating the database

USE `diary_app`;

ALTER TABLE users 
ADD COLUMN security_question VARCHAR(255) NULL AFTER password_hash,
ADD COLUMN security_answer VARCHAR(255) NULL AFTER security_question;
