<?php
namespace vivek\CommandPack\Support\Helpers;

use Illuminate\Support\Str;

class ViewHelper{
    public static function createFile(string $command, string $base,  $logger, string $ext, string $namespace, $stub_name)
    {
        $all = explode("/", $command);
        $dir_path = $base;
        foreach($all as $key => $dir) {
            if($key !== count($all) - 1 && !is_dir($dir_path . "/" . $dir )) {
                if($dir[0] === "{" && $dir[strlen($dir) - 1] === "}"){
                    $nested_dirs = explode(",", $dir);
                    foreach ($nested_dirs as $nested_dir) {
                        mkdir($dir_path . "/" . Str::of($nested_dir)->trim("{}"));
                    }
                }else {
                    mkdir($dir_path . "/" . $dir );
                }
            }
        }
        if($all[count($all) - 1][0] === "{" &&
            $all[count($all) - 1][strlen($all[count($all) - 1]) - 1] === "}"
        ){
            $files = explode(",", $all[count($all) - 1]);
            $directory = substr($command, 0, strrpos($command, '/'));

            if($directory[0] === "{" && $directory[strlen($directory) - 1] === "}")
            {
                $nested_dirs = explode(",", $directory);
                foreach ($nested_dirs as $nested_dir) {
                    $current_folder =  Str::of($nested_dir)->trim("{}");
                    ViewHelper::create_nested_files($files, $dir_path, $current_folder, $ext, $logger, $namespace, $stub_name);
                }
            }else {
                ViewHelper::create_nested_files($files, $dir_path, $directory, $ext, $logger, $namespace, $stub_name);
            }
        }else {
            ViewHelper::create_file($dir_path . "/" . $command . $ext, $command . $ext, $logger, $namespace, $stub_name);

        }
    }

    public static function create_file (string $file_path, string $current_file, $logger,  string $namespace, string $stub_name)
    {
      if(!file_exists($file_path)){
          $fileLocation = $file_path;
          $file = fopen($fileLocation,"w");
          $className = ucfirst(explode(".", explode("/", $current_file)[count(explode("/", $current_file)) - 1])[0]);
          $content = ViewHelper::get_stub($stub_name, $namespace, $className);
          fwrite($file,$content);
          fclose($file);
          $logger->info("File created: " . $current_file );
      }else {
          $logger->warn("File exists: " . $current_file  );
      }
    }
    public static function get_stub (string $file_name, string $namespace, string $className)
    {
        $stubPath = __DIR__ . '/../../stubs/' . $file_name . '.stub'; 

        $stub = file_get_contents($stubPath);

        $stub = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $className],
            $stub
        );
        return $stub;
    }
    protected static function create_nested_files(array $files, $dir_path, $directory, $ext, $logger, $namespace, $stub_name)
    {
        foreach ($files as $file) {
            $current_file = Str::of($file)->trim("{}");
            $new_file_path = $dir_path . "/" . $directory . "/" . $current_file . $ext;
            $displayName = $directory . "/". $current_file .$ext;
            ViewHelper::create_file($new_file_path, $displayName, $logger, $namespace, $stub_name);
        }
    }
}
