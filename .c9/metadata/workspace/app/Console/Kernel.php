{"filter":false,"title":"Kernel.php","tooltip":"/app/Console/Kernel.php","undoManager":{"mark":32,"position":32,"stack":[[{"start":{"row":26,"column":37},"end":{"row":27,"column":0},"action":"remove","lines":["",""],"id":2}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":3}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":4}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":5}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":6}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":7}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":8}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":9}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":10}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":11}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":12}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":13}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":14}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":15}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":16}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":17}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":18}],[{"start":{"row":26,"column":37},"end":{"row":26,"column":38},"action":"remove","lines":[" "],"id":19}],[{"start":{"row":26,"column":48},"end":{"row":27,"column":0},"action":"insert","lines":["",""],"id":20},{"start":{"row":27,"column":0},"end":{"row":27,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":27,"column":8},"end":{"row":27,"column":62},"action":"insert","lines":["$schedule->command('queue:work')->cron('* * * * * *');"],"id":21}],[{"start":{"row":27,"column":8},"end":{"row":27,"column":62},"action":"remove","lines":["$schedule->command('queue:work')->cron('* * * * * *');"],"id":23},{"start":{"row":27,"column":8},"end":{"row":27,"column":91},"action":"insert","lines":["$schedule->command('queue:work database --queue=default --tries=3')->everyMinute();"]}],[{"start":{"row":27,"column":73},"end":{"row":27,"column":74},"action":"insert","lines":[" "],"id":24}],[{"start":{"row":27,"column":74},"end":{"row":27,"column":75},"action":"insert","lines":["-"],"id":25}],[{"start":{"row":27,"column":75},"end":{"row":27,"column":76},"action":"insert","lines":["-"],"id":26}],[{"start":{"row":27,"column":75},"end":{"row":27,"column":76},"action":"remove","lines":["-"],"id":27}],[{"start":{"row":27,"column":74},"end":{"row":27,"column":75},"action":"remove","lines":["-"],"id":28}],[{"start":{"row":27,"column":74},"end":{"row":27,"column":86},"action":"insert","lines":["--timeout=60"],"id":29}],[{"start":{"row":27,"column":85},"end":{"row":27,"column":86},"action":"remove","lines":["0"],"id":30}],[{"start":{"row":27,"column":84},"end":{"row":27,"column":85},"action":"remove","lines":["6"],"id":31}],[{"start":{"row":27,"column":84},"end":{"row":27,"column":85},"action":"insert","lines":["5"],"id":32}],[{"start":{"row":27,"column":85},"end":{"row":27,"column":86},"action":"insert","lines":["0"],"id":33}],[{"start":{"row":27,"column":86},"end":{"row":27,"column":87},"action":"insert","lines":["0"],"id":34}],[{"start":{"row":26,"column":48},"end":{"row":27,"column":105},"action":"remove","lines":["","        $schedule->command('queue:work database --queue=default --tries=3 --timeout=500')->everyMinute();"],"id":38}]]},"ace":{"folds":[],"scrolltop":271,"scrollleft":0,"selection":{"start":{"row":26,"column":48},"end":{"row":26,"column":48},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1450142571907,"hash":"0efedba5aa2727cd205997e8ee17be1639e40df4"}