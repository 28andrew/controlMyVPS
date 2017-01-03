function pull(){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
          var rawJson = readBody(xhr);
          //console.log(rawJson);
          var json = JSON.parse(rawJson);
          //CPU
          postMessage(["html", "#cpuLoadPercentageDisplay", json.CPU.load.percentage + "%"]);
          postMessage(["style", "#cpuLoadPercentageBar", "width", json.CPU.load.percentage + "%"])
          //MEMORY
          postMessage(["html", "#memoryUsedPercentageDisplay", json.memory.used.percentage + "%"]);
          postMessage(["html", "#memoryRatioDisplay", json.memory.used.formatted + " / " + json.memory.total.formatted]);
          postMessage(["style", "#memoryUsedPercentageBar", "width", json.memory.used.percentage + "%"]);

          //BANDWIDTH
          //DISK
          postMessage(["html", "#diskUsedPercentageDisplay", json.disk.used.percentage + "%"]);
          postMessage(["style", "#diskUsedPercentageBar", "width", json.disk.used.percentage + "%"]);
      }
  }
  xhr.open('GET', '/data.php?json', true);
  xhr.send(null);
  setTimeout("pull()", 900);
}
pull();

// FUNCTIONS
function readBody(xhr) {
    var data;
    if (!xhr.responseType || xhr.responseType === "text") {
        data = xhr.responseText;
    } else if (xhr.responseType === "document") {
        data = xhr.responseXML;
    } else {
        data = xhr.response;
    }
    return data;
}
