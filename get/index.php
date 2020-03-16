<?php
/**
 * path 变量是接口返回的图片地址，供修改过的前端live2d.min.js 加载。
 * 必须在CDN目录前加上 +号（也可自己定义，但是在live2d.min.js 中也要匹配！）
 *
 * fox之后请将tokyohost 更改为你自己的git用户名。
 *
 * 可以测试以下访问如下链接是否有图片，如有则配置完成。（别忘了将链接中的tokyohost更改为你自己的用户名！!!）
 * https://cdn.jsdelivr.net/gh/tokyohost/live2d_api/model/HyperdimensionNeptunia/blanc_classic/textures.1024/01.png
 *
 */
$path = '+https://cdn.jsdelivr.net/gh/tokyohost/live2d_api/model/';
isset($_GET['id']) ? $id = $_GET['id'] : exit('error');

require '../tools/modelList.php';
require '../tools/modelTextures.php';
require '../tools/jsonCompatible.php';

$modelList = new modelList();
$modelTextures = new modelTextures();
$jsonCompatible = new jsonCompatible();

$id = explode('-', $id);
$modelId = (int)$id[0];
$modelTexturesId = isset($id[1]) ? (int)$id[1] : 0;

$modelName = $modelList->id_to_name($modelId);

if (is_array($modelName)) {
    $modelName = $modelTexturesId > 0 ? $modelName[$modelTexturesId-1] : $modelName[0];
    $json = json_decode(file_get_contents('../model/'.$modelName.'/index.json'), 1);
} else {
    $json = json_decode(file_get_contents('../model/'.$modelName.'/index.json'), 1);
    if ($modelTexturesId > 0) {
        $modelTexturesName = $modelTextures->get_name($modelName, $modelTexturesId);
        if (isset($modelTexturesName)) $json['textures'] = is_array($modelTexturesName) ? $modelTexturesName : array($modelTexturesName);
    }
}

$textures = json_encode($json['textures']);
$textures = str_replace('texture', $path.$modelName.'/texture', $textures);
$textures = json_decode($textures, 1);
$json['textures'] = $textures;

$json['model'] = $path.$modelName.'/'.$json['model'];
if (isset($json['pose'])) $json['pose'] = $path.$modelName.'/'.$json['pose'];
if (isset($json['physics'])) $json['physics'] = $path.$modelName.'/'.$json['physics'];

if (isset($json['motions'])) {
    $motions = json_encode($json['motions']);
    $motions = str_replace('sounds', '../model/'.$modelName.'/sounds', $motions);
    $motions = str_replace('motions', $path.$modelName.'/motions', $motions);
    $motions = json_decode($motions, 1);
    $json['motions'] = $motions;
}

if (isset($json['expressions'])) {
    $expressions = json_encode($json['expressions']);
    $expressions = str_replace('expressions', $path.$modelName.'/expressions', $expressions);
    $expressions = json_decode($expressions, 1);
    $json['expressions'] = $expressions;
}


header("Content-type: application/json");
echo $jsonCompatible->json_encode($json);
