-- Создание базы данных для Test API
-- Запустите этот скрипт в MySQL для создания базы данных

CREATE DATABASE IF NOT EXISTS `api` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `api`;

-- Создание таблицы tasks
CREATE TABLE IF NOT EXISTS `tasks` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `status` ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Вставка тестовых данных
INSERT INTO `tasks` (`title`, `description`, `status`) VALUES
('Изучить Laravel', 'Изучить основы Laravel framework для создания REST API', 'pending'),
('Создать API', 'Реализовать CRUD операции для управления задачами', 'in_progress'),
('Написать тесты', 'Создать unit тесты для проверки функциональности', 'pending');

-- Проверка данных
SELECT * FROM `tasks`;
