# Expense-Tracker
Database Setup
1.Create a MySQL database named expense_tracker.
2.Use the expense_tracker database.
3.Run the following SQL queries to create the necessary tables:

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
![image](https://github.com/Thushana24/Expense-Tracker/assets/117504789/ec1920b2-e4e2-4371-a325-7003491696d5)


CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    type ENUM('income', 'expense', 'saving', 'special_expense') NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    description VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
![image](https://github.com/Thushana24/Expense-Tracker/assets/117504789/a75e6ddc-a7b9-4fa3-b586-a85342377656)

