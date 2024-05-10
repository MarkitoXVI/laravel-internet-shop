<?php

namespace Core;

class Request
{
    protected array $data;
    protected array $server;

    public function __construct($data, $server)
    {
        $this->data = $data;
        $this->server = $server;
        foreach ($this->data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function all()
    {
        return $this->data;
    }

    public function input($key)
    {
        return $this->data[$key];
    }

    public function validate($data)
    {
        $errors = [];
        foreach ($data as $key => $value) {
            $field = $key;
            try {
                $field_value = $this->data[$field];
            } catch (\Exception $e) {
                $field_value = null;
            }
            is_array($value) ?: $value = explode('|', $value);
            $rules = $value;
            foreach ($rules as $rule) {
                $rule = explode(':', $rule);
                $rule_name = $rule[0];
                $rule_value = $rule[1] ?? null;
                try {
                    $result = Validator::$rule_name($field_value, $rule_value);
                } catch (\Exception $e) {
                    $result = $e->getMessage();
                }
                if ($result) {
                    $errors[$field][] = "The {$field} {$result}";
                }
            }

        }
        if ($errors) {
            $errors = json_encode($errors);
            setcookie('errors', $errors, time() + (86400 * 30), $this->server['REQUEST_URI']);
            header('Location: ' . $this->server['REQUEST_URI']);
            exit();
        }
    }
}