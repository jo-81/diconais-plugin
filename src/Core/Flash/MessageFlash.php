<?php

namespace Diconais\Core\Flash;

class MessageFlash
{
    private static string $option_name = '_dn_flash_messages';

    /**
     * add
     *
     * @param  string $message
     * @param  string $type
     * @param  string|null $key
     * @return void
     */
    public static function add(string $message, string $type = 'info', ?string $key = null): void
    {
        $messages = get_option(self::$option_name, []);
        if (is_null($key)) {
            $messages[] = [ 'text' => sanitize_text_field($message), 'type' => sanitize_key($type) ];
        } else {
            $messages[$key][] = [ 'text' => sanitize_text_field($message), 'type' => sanitize_key($type) ];
        }

        add_option(self::$option_name, $messages, '', false);
    }

    /**
     * get
     *
     * @param  string|null $key
     * @return mixed[]
     */
    public static function get(?string $key = null): array
    {
        $messages = get_option(self::$option_name, []);
        $messages = isset($messages[$key]) ? $messages[$key] : $messages;

        if (! empty($messages)) {
            delete_option(self::$option_name);
        }

        return $messages;
    }
}
