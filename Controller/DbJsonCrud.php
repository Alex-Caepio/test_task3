<?php

class DbJsonCrud
{
    private string $dbPath;

    public function __construct(string $dbPath)
    {
        $this->dbPath = $dbPath;
    }

    public function getFileName(): string
    {
        return $this->dbPath;
    }

    public function read(): array
    {
        $data = file_get_contents($this->dbPath, true);
        if (empty($data)) {
            $data = '{}';
            file_put_contents($this->dbPath, $data);
        }
        return json_decode($data, true);
    }

    public function write(array $data): void
    {
        $json_data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->dbPath, $json_data);
    }

    public function add(array $data): void
    {
        $json_data = $this->read();
        $json_data[] = $data;
        $this->write($json_data);
    }

    public function update(array $data, int $id): void
    {
        $json_data = $this->read();
        $json_data[$id] = $data;
        $this->write($json_data);
    }

    public function delete(int $id): void
    {
        $json_data = $this->read();
        unset($json_data[$id]);
        $this->write($json_data);
    }

    public function findLogin(string $login): array
    {
        $json_data = $this->read();
        foreach ($json_data as $key => $value) {
            if ($value['login'] === $login) {
                return $value;
            }
        }
        return [];
    }

    public function findUserPassword(string $login, string $password): array
    {
        $json_data = $this->read();
        foreach ($json_data as $key => $value) {
            if ($value['login'] === $login && $value['password'] === $password) {
                return $value;
            }
        }
        return [];
    }

    public function readPassword(string $login): string
    {
        $json_data = $this->read();
        foreach ($json_data as $key => $value) {
            if ($value['login'] === $login) {
                return $value['password'];
            }
        }
        return '';
    }
}