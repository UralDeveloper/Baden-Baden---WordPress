<?php
// Функция для отправки уведомлений администратору
function send_admin_notification($message) {
    wp_mail(get_option('admin_email'), 'Auto Update Notification', $message);
}

// Получаем адрес текущей активной темы
$current_theme = wp_get_theme();
$theme_slug = $current_theme->get_stylesheet(); // slug темы
$repo_url = 'https://api.github.com/repos/{owner}/{repo}/releases/latest'; // ссылка на GitHub API для последних релизов

// Параметры подключения к GitHub
define('GITHUB_OWNER', '{your_github_username}');
define('GITHUB_REPO', '{your_repository_name}');

// Формируем полную ссылку на последний релиз
$full_repo_url = str_replace(['{owner}', '{repo}'], [GITHUB_OWNER, GITHUB_REPO], $repo_url);

try {
    // Запрашиваем данные последнего релиза
    $response = wp_remote_get($full_repo_url);
    
    if (!is_wp_error($response)) {
        $data = json_decode(wp_remote_retrieve_body($response));
        
        if ($data && isset($data->tag_name)) {
            $latest_version = trim($data->tag_name); // Новая версия
            
            // Текущая версия темы
            $current_version = $current_theme->get('Version');
            
            if (version_compare($latest_version, $current_version, '>')) { // Есть новая версия!
                echo "Обнаружено обновление до версии {$latest_version}.";
                
                // Скачиваем архив
                $download_link = $data->zipball_url;
                $temp_file = download_url($download_link);
                
                if (!is_wp_error($temp_file)) {
                    // Распаковка архива
                    require_once(ABSPATH . 'wp-admin/includes/file.php'); // Загрузка функций для обработки файлов
                    
                    WP_Filesystem();
                    global $wp_filesystem;
                    
                    $unpacked_dir = trailingslashit(WP_CONTENT_DIR) . 'upgrade/' . uniqid() . '/';
                    mkdir($unpacked_dir);
                    
                    // Разархивируем содержимое ZIP-файла
                    unzip_file($temp_file, $unpacked_dir);
                    
                    // Определяем путь к распакованной теме
                    $theme_folder = glob($unpacked_dir . '*')[0];
                    
                    // Замещаем текущую тему новой версией
                    copy_dir($theme_folder, get_template_directory());
                    
                    unlink($temp_file); // удаляем временный zip-файл
                    rmdir_recursive($unpacked_dir); // очищаем временную директорию
                    
                    send_admin_notification("Тема успешно обновлена до версии {$latest_version}");
                } else {
                    throw new Exception("Ошибка скачивания архива.");
                }
            } else {
                echo "Тема актуальна.";
            }
        } else {
            throw new Exception("Невозможно определить последнюю версию.");
        }
    } else {
        throw new Exception("Ошибка при получении данных с GitHub.");
    }
} catch (Exception $e) {
    send_admin_notification("Ошибка обновления темы: " . $e->getMessage());
}