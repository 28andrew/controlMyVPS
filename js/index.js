var w;

function startWorker() {
    if(typeof(Worker) !== "undefined") {
        if(typeof(w) == "undefined") {
            w = new Worker("/js/data_pull.js");
        }
        w.onmessage = function(event) {
            var data = event.data;
            var type = data[0];
            var selector = data[1];
            if (type == "html"){
              var newHTML = data[2];
              $(selector).html(newHTML);
            }else if (type == "style"){
              var propertyName = data[2];
              var value = data[3];
              $(selector).css(propertyName, value);
            }
        };
    } else {
        document.getElementById("result").innerHTML = "Sorry! No Web Worker support.";
    }
}

function stopWorker() {
    w.terminate();
    w = undefined;
}

startWorker();
