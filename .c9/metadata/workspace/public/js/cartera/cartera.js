{"filter":false,"title":"cartera.js","tooltip":"/public/js/cartera/cartera.js","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":110,"column":24},"end":{"row":110,"column":25},"action":"remove","lines":["a"],"id":1488}],[{"start":{"row":110,"column":24},"end":{"row":110,"column":25},"action":"remove","lines":["g"],"id":1489}],[{"start":{"row":110,"column":24},"end":{"row":110,"column":25},"action":"insert","lines":["a"],"id":1490}],[{"start":{"row":110,"column":25},"end":{"row":110,"column":26},"action":"insert","lines":["f"],"id":1491}],[{"start":{"row":110,"column":25},"end":{"row":110,"column":26},"action":"remove","lines":["f"],"id":1492}],[{"start":{"row":110,"column":25},"end":{"row":110,"column":26},"action":"insert","lines":["g"],"id":1493}],[{"start":{"row":110,"column":42},"end":{"row":110,"column":43},"action":"insert","lines":["."],"id":1494}],[{"start":{"row":110,"column":43},"end":{"row":110,"column":44},"action":"insert","lines":["m"],"id":1495}],[{"start":{"row":110,"column":44},"end":{"row":110,"column":45},"action":"insert","lines":["o"],"id":1496}],[{"start":{"row":110,"column":45},"end":{"row":110,"column":46},"action":"insert","lines":["d"],"id":1497}],[{"start":{"row":110,"column":46},"end":{"row":110,"column":47},"action":"insert","lines":["a"],"id":1498}],[{"start":{"row":110,"column":47},"end":{"row":110,"column":48},"action":"insert","lines":["l"],"id":1499}],[{"start":{"row":110,"column":48},"end":{"row":110,"column":50},"action":"insert","lines":["()"],"id":1500}],[{"start":{"row":110,"column":49},"end":{"row":110,"column":51},"action":"insert","lines":["''"],"id":1501}],[{"start":{"row":110,"column":50},"end":{"row":110,"column":51},"action":"insert","lines":["h"],"id":1502}],[{"start":{"row":110,"column":51},"end":{"row":110,"column":52},"action":"insert","lines":["i"],"id":1503}],[{"start":{"row":110,"column":52},"end":{"row":110,"column":53},"action":"insert","lines":["d"],"id":1504}],[{"start":{"row":110,"column":53},"end":{"row":110,"column":54},"action":"insert","lines":["e"],"id":1505}],[{"start":{"row":110,"column":56},"end":{"row":110,"column":57},"action":"insert","lines":[";"],"id":1506}],[{"start":{"row":120,"column":1},"end":{"row":121,"column":0},"action":"insert","lines":["",""],"id":1507}],[{"start":{"row":121,"column":0},"end":{"row":122,"column":0},"action":"insert","lines":["",""],"id":1508}],[{"start":{"row":122,"column":0},"end":{"row":140,"column":1},"action":"insert","lines":["function ver_cartera(){","    var distribuidor = $('[data-id=\"subPicker_distri\"]').text();","    $('#modal-loading').modal({","        backdrop: 'static',","        keyboard: false","        })","    $.ajax({","        url:'cartera/datos',","        data:{distribuidor:distribuidor},","        type:'GET',","        success: function(data){","            $('#modal-loading').modal(\"hide\");","            $('#registros_container').html(data);","            $('html, body').animate({","                    scrollTop: $(\"#total\").offset().top","                    }, 500);","        }","    });","}"],"id":1509}],[{"start":{"row":122,"column":9},"end":{"row":122,"column":12},"action":"remove","lines":["ver"],"id":1510},{"start":{"row":122,"column":9},"end":{"row":122,"column":10},"action":"insert","lines":["d"]}],[{"start":{"row":122,"column":10},"end":{"row":122,"column":11},"action":"insert","lines":["e"],"id":1511}],[{"start":{"row":122,"column":11},"end":{"row":122,"column":12},"action":"insert","lines":["s"],"id":1512}],[{"start":{"row":122,"column":12},"end":{"row":122,"column":13},"action":"insert","lines":["c"],"id":1513}],[{"start":{"row":122,"column":13},"end":{"row":122,"column":14},"action":"insert","lines":["a"],"id":1514}],[{"start":{"row":122,"column":14},"end":{"row":122,"column":15},"action":"insert","lines":["r"],"id":1515}],[{"start":{"row":122,"column":15},"end":{"row":122,"column":16},"action":"insert","lines":["g"],"id":1516}],[{"start":{"row":122,"column":16},"end":{"row":122,"column":17},"action":"insert","lines":["r"],"id":1517}],[{"start":{"row":122,"column":17},"end":{"row":122,"column":18},"action":"insert","lines":["a"],"id":1518}],[{"start":{"row":122,"column":18},"end":{"row":122,"column":19},"action":"insert","lines":["r"],"id":1519}],[{"start":{"row":122,"column":27},"end":{"row":122,"column":28},"action":"insert","lines":["_"],"id":1520}],[{"start":{"row":122,"column":28},"end":{"row":122,"column":29},"action":"insert","lines":["a"],"id":1521}],[{"start":{"row":122,"column":29},"end":{"row":122,"column":30},"action":"insert","lines":["d"],"id":1522}],[{"start":{"row":122,"column":30},"end":{"row":122,"column":31},"action":"insert","lines":["m"],"id":1523}],[{"start":{"row":122,"column":31},"end":{"row":122,"column":32},"action":"insert","lines":["n"],"id":1524}],[{"start":{"row":122,"column":31},"end":{"row":122,"column":32},"action":"remove","lines":["n"],"id":1525}],[{"start":{"row":122,"column":31},"end":{"row":122,"column":32},"action":"insert","lines":["i"],"id":1526}],[{"start":{"row":122,"column":32},"end":{"row":122,"column":33},"action":"insert","lines":["n"],"id":1527}],[{"start":{"row":129,"column":25},"end":{"row":129,"column":26},"action":"remove","lines":["s"],"id":1528}],[{"start":{"row":129,"column":24},"end":{"row":129,"column":25},"action":"remove","lines":["o"],"id":1529}],[{"start":{"row":129,"column":23},"end":{"row":129,"column":24},"action":"remove","lines":["t"],"id":1530}],[{"start":{"row":129,"column":22},"end":{"row":129,"column":23},"action":"remove","lines":["a"],"id":1531}],[{"start":{"row":129,"column":22},"end":{"row":129,"column":23},"action":"insert","lines":["e"],"id":1532}],[{"start":{"row":129,"column":23},"end":{"row":129,"column":24},"action":"insert","lines":["s"],"id":1533}],[{"start":{"row":129,"column":24},"end":{"row":129,"column":25},"action":"insert","lines":["c"],"id":1534}],[{"start":{"row":129,"column":25},"end":{"row":129,"column":26},"action":"insert","lines":["a"],"id":1535}],[{"start":{"row":129,"column":26},"end":{"row":129,"column":27},"action":"insert","lines":["r"],"id":1536}],[{"start":{"row":129,"column":27},"end":{"row":129,"column":28},"action":"insert","lines":["g"],"id":1537}],[{"start":{"row":129,"column":28},"end":{"row":129,"column":29},"action":"insert","lines":["a"],"id":1538}],[{"start":{"row":129,"column":29},"end":{"row":129,"column":30},"action":"insert","lines":["r"],"id":1539}],[{"start":{"row":133,"column":46},"end":{"row":137,"column":28},"action":"remove","lines":["","            $('#registros_container').html(data);","            $('html, body').animate({","                    scrollTop: $(\"#total\").offset().top","                    }, 500);"],"id":1540}],[{"start":{"row":136,"column":1},"end":{"row":137,"column":0},"action":"insert","lines":["",""],"id":1541}],[{"start":{"row":137,"column":0},"end":{"row":138,"column":0},"action":"insert","lines":["",""],"id":1542}],[{"start":{"row":138,"column":0},"end":{"row":152,"column":1},"action":"insert","lines":["function descargrar_cartera_admin(){","    var distribuidor = $('[data-id=\"subPicker_distri\"]').text();","    $('#modal-loading').modal({","        backdrop: 'static',","        keyboard: false","        })","    $.ajax({","        url:'cartera/descargar',","        data:{distribuidor:distribuidor},","        type:'GET',","        success: function(data){","            $('#modal-loading').modal(\"hide\");","        }","    });","}"],"id":1543}],[{"start":{"row":138,"column":27},"end":{"row":138,"column":33},"action":"remove","lines":["_admin"],"id":1544}],[{"start":{"row":138,"column":30},"end":{"row":139,"column":64},"action":"remove","lines":["","    var distribuidor = $('[data-id=\"subPicker_distri\"]').text();"],"id":1545}],[{"start":{"row":145,"column":27},"end":{"row":145,"column":39},"action":"remove","lines":["distribuidor"],"id":1546},{"start":{"row":145,"column":27},"end":{"row":145,"column":28},"action":"insert","lines":["n"]}],[{"start":{"row":145,"column":28},"end":{"row":145,"column":29},"action":"insert","lines":["u"],"id":1547}],[{"start":{"row":145,"column":29},"end":{"row":145,"column":30},"action":"insert","lines":["l"],"id":1548}],[{"start":{"row":145,"column":30},"end":{"row":145,"column":31},"action":"insert","lines":["l"],"id":1549}],[{"start":{"row":138,"column":16},"end":{"row":138,"column":17},"action":"remove","lines":["r"],"id":1550}],[{"start":{"row":122,"column":16},"end":{"row":122,"column":17},"action":"remove","lines":["r"],"id":1551}],[{"start":{"row":138,"column":9},"end":{"row":138,"column":26},"action":"remove","lines":["descargar_cartera"],"id":1552},{"start":{"row":138,"column":9},"end":{"row":138,"column":26},"action":"insert","lines":["descargar_cartera"]}],[{"start":{"row":147,"column":32},"end":{"row":148,"column":0},"action":"insert","lines":["",""],"id":1553},{"start":{"row":148,"column":0},"end":{"row":148,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":148,"column":12},"end":{"row":157,"column":17},"action":"insert","lines":["if(data == 1){","                    $('.modal-header #modal-tittle').html('Exito');","                    $('.modal-body #modal-body').html(\"Registro agregado. debe actualizar la página para ver el total actualizado\");","                    $('#modal-content').modal('show'); ","                    $('#agregar_registro').modal('hide');","                }else{","                    $('.modal-header #modal-tittle').html('Error');","                    $('.modal-body #modal-body').html(data);","                    $('#modal-content').modal('show'); ","                }"],"id":1554}],[{"start":{"row":149,"column":0},"end":{"row":149,"column":4},"action":"remove","lines":["    "],"id":1555},{"start":{"row":150,"column":0},"end":{"row":150,"column":4},"action":"remove","lines":["    "]},{"start":{"row":151,"column":0},"end":{"row":151,"column":4},"action":"remove","lines":["    "]},{"start":{"row":152,"column":0},"end":{"row":152,"column":4},"action":"remove","lines":["    "]},{"start":{"row":153,"column":0},"end":{"row":153,"column":4},"action":"remove","lines":["    "]},{"start":{"row":154,"column":0},"end":{"row":154,"column":4},"action":"remove","lines":["    "]},{"start":{"row":155,"column":0},"end":{"row":155,"column":4},"action":"remove","lines":["    "]},{"start":{"row":156,"column":0},"end":{"row":156,"column":4},"action":"remove","lines":["    "]},{"start":{"row":157,"column":0},"end":{"row":157,"column":4},"action":"remove","lines":["    "]}],[{"start":{"row":149,"column":63},"end":{"row":152,"column":53},"action":"remove","lines":["","                $('.modal-body #modal-body').html(\"Registro agregado. debe actualizar la página para ver el total actualizado\");","                $('#modal-content').modal('show'); ","                $('#agregar_registro').modal('hide');"],"id":1556}],[{"start":{"row":148,"column":26},"end":{"row":149,"column":63},"action":"remove","lines":["","                $('.modal-header #modal-tittle').html('Exito');"],"id":1557}],[{"start":{"row":148,"column":20},"end":{"row":148,"column":21},"action":"remove","lines":["="],"id":1558}],[{"start":{"row":148,"column":20},"end":{"row":148,"column":21},"action":"insert","lines":["!"],"id":1559}],[{"start":{"row":148,"column":25},"end":{"row":149,"column":18},"action":"remove","lines":["{","            }else{"],"id":1560}],[{"start":{"row":148,"column":25},"end":{"row":148,"column":26},"action":"insert","lines":["{"],"id":1561}],[{"start":{"row":132,"column":32},"end":{"row":133,"column":0},"action":"insert","lines":["",""],"id":1562},{"start":{"row":133,"column":0},"end":{"row":133,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":133,"column":12},"end":{"row":137,"column":13},"action":"insert","lines":["if(data != 1){","                $('.modal-header #modal-tittle').html('Error');","                $('.modal-body #modal-body').html(data);","                $('#modal-content').modal('show'); ","            }"],"id":1563}],[{"start":{"row":137,"column":13},"end":{"row":137,"column":14},"action":"insert","lines":["e"],"id":1564}],[{"start":{"row":137,"column":14},"end":{"row":137,"column":15},"action":"insert","lines":["l"],"id":1565}],[{"start":{"row":137,"column":15},"end":{"row":137,"column":16},"action":"insert","lines":["s"],"id":1566}],[{"start":{"row":137,"column":16},"end":{"row":137,"column":17},"action":"insert","lines":["e"],"id":1567}],[{"start":{"row":137,"column":17},"end":{"row":137,"column":18},"action":"insert","lines":["{"],"id":1568}],[{"start":{"row":137,"column":18},"end":{"row":139,"column":13},"action":"insert","lines":["","                ","            }"],"id":1569}],[{"start":{"row":138,"column":16},"end":{"row":138,"column":87},"action":"insert","lines":["document.getElementById('my_iframe').src = \"temp/estadoSimcards.csv\";  "],"id":1570}],[{"start":{"row":138,"column":65},"end":{"row":138,"column":79},"action":"remove","lines":["estadoSimcards"],"id":1571},{"start":{"row":138,"column":65},"end":{"row":138,"column":66},"action":"insert","lines":["c"]}],[{"start":{"row":138,"column":66},"end":{"row":138,"column":67},"action":"insert","lines":["a"],"id":1572}],[{"start":{"row":138,"column":67},"end":{"row":138,"column":68},"action":"insert","lines":["r"],"id":1573}],[{"start":{"row":138,"column":68},"end":{"row":138,"column":69},"action":"insert","lines":["t"],"id":1574}],[{"start":{"row":138,"column":69},"end":{"row":138,"column":70},"action":"insert","lines":["e"],"id":1575}],[{"start":{"row":138,"column":70},"end":{"row":138,"column":71},"action":"insert","lines":["r"],"id":1576}],[{"start":{"row":138,"column":71},"end":{"row":138,"column":72},"action":"insert","lines":["a"],"id":1577}],[{"start":{"row":159,"column":13},"end":{"row":159,"column":14},"action":"insert","lines":["e"],"id":1578}],[{"start":{"row":159,"column":14},"end":{"row":159,"column":15},"action":"insert","lines":["l"],"id":1579}],[{"start":{"row":159,"column":15},"end":{"row":159,"column":16},"action":"insert","lines":["s"],"id":1580}],[{"start":{"row":159,"column":16},"end":{"row":159,"column":17},"action":"insert","lines":["e"],"id":1581}],[{"start":{"row":159,"column":17},"end":{"row":159,"column":18},"action":"insert","lines":["{"],"id":1582}],[{"start":{"row":159,"column":18},"end":{"row":161,"column":13},"action":"insert","lines":["","                ","            }"],"id":1583}],[{"start":{"row":160,"column":16},"end":{"row":160,"column":80},"action":"insert","lines":["document.getElementById('my_iframe').src = \"temp/cartera.csv\";  "],"id":1584}],[{"start":{"row":2,"column":0},"end":{"row":2,"column":4},"action":"remove","lines":["    "],"id":1585},{"start":{"row":3,"column":0},"end":{"row":3,"column":4},"action":"remove","lines":["    "]}],[{"start":{"row":2,"column":0},"end":{"row":2,"column":4},"action":"remove","lines":["    "],"id":1586},{"start":{"row":3,"column":0},"end":{"row":3,"column":4},"action":"remove","lines":["    "]}],[{"start":{"row":2,"column":0},"end":{"row":2,"column":4},"action":"remove","lines":["    "],"id":1587},{"start":{"row":3,"column":0},"end":{"row":3,"column":4},"action":"remove","lines":["    "]}],[{"start":{"row":2,"column":0},"end":{"row":2,"column":4},"action":"remove","lines":["    "],"id":1588},{"start":{"row":3,"column":0},"end":{"row":3,"column":4},"action":"remove","lines":["    "]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":3,"column":12},"end":{"row":3,"column":12},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1450916960034,"hash":"62d8802854bc4d0e23de18cdec5f8fd15e8a98af"}