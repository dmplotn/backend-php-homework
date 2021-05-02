**Операции с геометрическими фигурами**
----

Возвращает результат операции над геометрической фигурой

* **Точка входа**

  /api/figureCalculator.php

* **HTTP-метод**

  `GET`
  
* **Параметры**

  - figure=[string]
    
    - Rectangle
    - Cuboid
    - Circle
    - Sphere

  - operation=[string]
    - getArea (доступен для всех типов фигур)
    - getPerimeter (доступен для: Rectangle, Circle)
    - getVolume (доступен для: Cuboid, Sphere)
    - getRatio (доступен для всех типов фигур)
   
  - propName=[double] (вместо propName должно быть подставлено одно из следующих свойств)
    - для Rectangle: width, length
    - для Cuboid: width, length, height
    - для Circle: radius
    - для Sphere: radius

* **Формат ответа**

    - Код: 200
      
      Содержимое: `{ status: "success", message: "Запрос успешно выполнен.", result: 850 }`
    
    - Код: 422
      
      Содержимое: `{ status: "error", message: "Запрос был отправлен с не правильным набором параметров." }`
      
    - Код: 404
      
      Содержимое: `{ status: "error", message: "Ресурс не найден." }`
