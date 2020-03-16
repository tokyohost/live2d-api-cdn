# Live2D API CDN

#简介
糟蹋大佬的[项目](https://github.com/fghrsh/live2d_api)而来.

配合 [live2d-cdn](https://github.com/tokyohost/live2d-cdn) 可完成资源加载完全cdn化，提升看板娘加载速度。

### 修改此接口返回CDN资源配置方法

- 下载这个项目
 
- 修改/get/index.php中的```$path```参数    
    修改方法：  
    原配置：   
    ```$path = '+https://cdn.jsdelivr.net/gh/tokyohost/live2d_api/model/';```
    修改为：
    ```$path = '+https://cdn.jsdelivr.net/gh/你的用户名/live2d_api/model/';```
    
    参数前的```'+'```符号可替换但不能缺少。
    
    注意替换```'+'```必须替换 ```live2d.min.js``` 中的参数，他们是约定的。
    
### 简单部署

- 下载这个项目
- 解压得到 /live2d-api/*
- 配置cdn资源链接
- 上传至网址根目录
- 确保php环境可用
- 访问: https://你的网址/live2d-api/get/?id=2-12
- 如返回json 数据则部署成功！。

### 接口用法
- `/add/` - 检测 新增皮肤 并更新 缓存列表
- `/get/?id=1-23` 获取 分组 1 的 第 23 号 皮肤
- `/rand/?id=1` 根据 上一分组 随机切换
- `/switch/?id=1` 根据 上一分组 顺序切换
- `/rand_textures/?id=1-23` 根据 上一皮肤 随机切换 同分组其他皮肤
- `/switch_textures/?id=1-23` 根据 上一皮肤 顺序切换 同分组其他皮肤

## 版权声明

**API 内所有模型 版权均属于原作者，仅供研究学习，不得用于商业用途**  

MIT © FGHRSH
