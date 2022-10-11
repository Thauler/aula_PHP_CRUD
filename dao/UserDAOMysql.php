<?php
require_once 'models/User.php';
require 'UserDAO.php';

/**
 *  This class implements UserDAO interface,
 * and use his methods to persist data on DB.
 *
 */
class UserDAOMysql implements UserDAO
{

    private PDO $pdo;

    /**
     * This is the constructor to start the PDO connection.
     * @param PDO $driver
     */
    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }


    /**
     * @param User $user
     * @return User
     */
    public function create(User $user): User
    {
        $sql = $this->pdo->prepare("INSERT INTO test.users (name, email) VALUES (:name, :email)");
        $sql->bindValue(':name', $user->getName());
        $sql->bindValue(':email', $user->getEmail());
        $sql->execute();

        $user->setId($this->pdo->lastInsertId());

        return $user;
    }

    /**
     * This method get all data from Table users.
     * @return array
     */
    public function findAll(): array
    {
        $array = array();

        $sql = $this->pdo->query("SELECT * FROM test.users");
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach ($data as $item) {
                $user = new User();
                $user->setId($item['id']);
                $user->setName($item['name']);
                $user->setEmail($item['email']);

                $array[] = $user;
            }
        }

        return $array;
    }


    /**
     * This method find a user by his ID
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        $sql = $this->pdo->prepare("SELECT * FROM test.users WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        return $this->sqlRowChecker($sql);
    }

    /**
     * This method find a user by his email
     * @param string $email
     * @return User | bool can't use union type on PHP 7.4 just on PHP 8.
     */
    public function findByEmail(string $email)
    {
        $sql = $this->pdo->prepare("SELECT * FROM test.users WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        return $this->sqlRowChecker($sql);
    }

    /**
     * This method update a user data
     * @param User $user
     * @return void
     */
    public function update(User $user): void
    {
        $sql = $this->pdo->prepare("UPDATE test.users SET name = :name, email = :email WHERE id = :id");
        $sql->bindValue(':name', $user->getName());
        $sql->bindValue(':email', $user->getEmail());
        $sql->bindValue(':id', $user->getId());
        $sql->execute();

    }

    /**
     * This method find a user by his ID and delete.
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }

    /**
     * This method checks if return anything from the query,
     * and return a user or false if the row is empty.
     *
     * @param $sql PDOStatement
     * @return false|User
     */
    private function sqlRowChecker(PDOStatement $sql)
    {
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
            $user = new User();
            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setEmail($data['email']);

            return $user;
        }

        return false;
    }

}