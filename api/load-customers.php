<?php

    header("Content-Type:application/json");

    require_once "lib/main.php";

    $conn = new CRUD(HOSTNAME, DBNAME, USERNAME, PASSWORD);
    $conn->open();

    $conn->cud(<<<STR
        create table if not exists customers_record(
            id int auto_increment,
            name varchar(32) not null,
            email_id varchar(32) not null unique,
            balance float default '0' not null,
            primary key (id)
        )
    STR);

    $conn->cud(<<<STR
        create table if not exists transactions_record(
            id int auto_increment,
            sid int not null,
            rid int not null,
            amount float not null,
            date_time datetime not null,
            primary key (id),
            foreign key (sid) references customers_record (id),
            foreign key (rid) references customers_record (id)
        )
    STR);


    $customers = [
        [
            "name" => "Saanvi",
            "email_id" => "saanvi@example.com",
            "balance" => 500
        ],
        [
            "name" => "Anika",
            "email_id" => "anika@example.com",
            "balance" => 1000
        ],
        [
            "name" => "Aditi",
            "email_id" => "aditi@example.com",
            "balance" => 120
        ],
        [
            "name" => "Kabir",
            "email_id" => "kabir@example.com",
            "balance" => 10
        ],
        [
            "name" => "Viraj",
            "email_id" => "viraj@example.com",
            "balance" => 5000
        ],
        [
            "name" => "Ishaan",
            "email_id" => "ishaan@example.com",
            "balance" => 50
        ],
        [
            "name" => "Adya",
            "email_id" => "adya@example.com",
            "balance" => 1200
        ],
        [
            "name" => "Arya",
            "email_id" => "arya@example.com",
            "balance" => 15
        ],
        [
            "name" => "Kuldeep",
            "email_id" => "kuldeep@example.com",
            "balance" => 3000
        ],
        [
            "name" => "Tanveer",
            "email_id" => "tanveer@example.com",
            "balance" => 2
        ]
    ];

    foreach($customers as $cust){
        
        [ "name" => $name, "email_id" => $email_id, "balance" => $balance ] = $cust;

        $res = $conn->cud("INSERT INTO customers_record (name, email_id, balance) VALUES ('${name}', '${email_id}', ${balance})");
        print_r($res);

    }

?>