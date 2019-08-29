<?php

namespace Key4Events\Models;

use \PDO;

class UserModel {

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var \Datetime
     */
    protected $createdAt;

    /**
     * @var \Datetime
     */
    protected $updatedAt;

    /**
     * @var PDO
     */
    private static $dbh;

    /**
     * Creates a new entity of PDO
     * 
     * @return PDO
     */
    public static function getDB() {

    if (empty(self::$dbh)) {
        $configData = parse_ini_file(__DIR__.'/../config.conf');
            
        try {
            self::$dbh = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
            );
        }
        catch(\Exception $exception) {
            echo 'Erreur de connexion...<br>';
            echo $exception->getMessage().'<br>';
            echo '<pre>';
            echo $exception->getTraceAsString();
            echo '</pre>';
            exit;
        }
    }
    return self::$dbh;
    }

    /*****************************/
    /*****   CRUD Methods    *****/
    /*****************************/

    /**
     * Get all users from DB
     * 
     * @return UserModel
     */
    public function findAll() {
        $stmt = self::getDB()->query("SELECT * FROM `user`;");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'UserModel');
    }

    /**
     * Get an user by id
     * 
     * @var string
     * @return UserModel
     */
    public function findById($id) {
        $stmt = self::getDB()->prepare("SELECT * FROM `user` WHERE `id` = :id;");
        $stmt->execute([':id' => $id]);
        return $stmt->fetchObject('UserModel');
    }

    /**
     * Create an user
     * 
     * @return int
     */
    public function create($lastname, $firstname, $email, $password) {
        $stmt = self::getDB()->prepare("INSERT INTO `user` (`lastname`, `firstname`, `email`, `password`) VALUES (:lastname, :firstname, :email, :password);");
        $stmt->execute([
            ':lastname' => $lastname,
            ':firstname' => $firstname,
            ':email' => $email,
            ':password' => $password
        ]);
        $done = $stmt->rowCount();
        if ($done) {
            $this->id = self::getDB()->lastInsertId();
        }
        return $done;
    }

    /**
     * Update an user
     * 
     * @return int
     */
    public function update($id, $lastname, $firstname, $email, $password) {
        $stmt = self::getDB()->prepare("UPDATE `user` SET `lastname` = :lastname, `firstname` = :firstname, `email` = :email, `password` = :password, `updated_at` = CURRENT_TIMESTAMP WHERE `id` = :id;");
        $stmt->execute([
            ':id' => $id,
            ':lastname' => $lastname,
            ':firstname' => $firstname,
            ':email' => $email,
            ':password' => $password
        ]);
        return $stmt->rowCount();
    }

    /**
     * Delete an user
     * 
     * @return int
     */
    public function delete($id) {
        $stmt = self::getDB()->prepare("DELETE FROM `user` WHERE `id` = :id;");
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount();
    }

    /*****************************/
    /*****      GETTERS      *****/
    /*****************************/

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of lastname
     *
     * @return  string
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Get the value of firstname
     *
     * @return  string
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of createdAt
     *
     * @return  \Datetime
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get the value of updatedAt
     *
     * @return  \Datetime
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}