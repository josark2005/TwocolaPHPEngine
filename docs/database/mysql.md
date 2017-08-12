# Twocola PHP Engine

**Database使用手册**

### 支持数据库
- Mysql
- SQLite3

---

### 实例

- 初始化

```
// 单表查询
$db = M("数据表名");
// 多表联合
$db = Mx("数据表a as a|数据表b as b");  // 以此类推
$db = Mx("data as a|base as b|users as c...");    // 例子
```

- 读取

```
假设数据库$dbname中存在test_table表
$db->Prefix = "test_";  //这里设置表前缀
$db->table("table")->select();  //取出多条数据
$db->table("table")->find();  //取出单条数据
//条件查询
$db->table("table")->where("uid>0")->order("username desc")->group("type")->select();
```

- 删除

```
假设数据库$dbname中存在test表
$db->table("test")->where("level<5")->delete(); //删除所有level小于5的记录
```

- 更新

```
假设数据库$dbname中存在test表,且存在一条如下数据
uid=3,username=jack,level=5
我们要更新这条记录（名字改为tom，等级改为6），代码如下：
$data['username'] = "tom";
$data['level'] = "6";
$db->table("test")->where("uid='3' AND level='5'")->save($data);
```

- 添加

```
假设数据库$dbname中存在test表
$data['uid'] = "1";
$data['username'] = "tom";
$data['level'] = "6";
$db->table("test")->add($data);
```

- 多表查询

```
table方法中使用xxx as x的格式添加数据表（表与表之间用|隔开）并且随之增加一个true参数。
$db->table("testa as a|testb as b",true)->find();

```

- 指定数据

```
需要取test数据表中的a,b字段
$db->find(a,b); // 单条数据
$db->select(a,b); // 多条数据
```

- 优化（非常用功能）

```
假设数据库$dbname中存在test表
$db->table("test")->optimize();
```

---

审核：Jokin

发布：Jokin

---
