comet
=====

Demos - how to implement comet by javascript and jquery. Server side is implemented with PHP.

I. Polling  (polling.html)

利用javascript的setInterval，定時利用ajax或JSONP去輪詢server端是否有資料更新。

優點：容易實現，不需要特別的伺服器。

缺點：發送請求的頻率太低則資料更新不夠快速。頻率太高則浪費頻寬。

註：另外有一種叫做peggyback polling的東西，他是在client需要時才發送請求，例如客戶按下submit的時候，其實是要驗證資料，但在驗證資料後，若server端有事件/訊息要送，就一起送回來。其優點是對資源的消耗就少，但缺點就是事件會累積在server端，直到client自己發出一個請求。

II. Comet

Comet是一個Web的應用模型，在此模型中，request會被發送到server端並保持一個很長的存活期，直到timeout或是server端有事件發生，當該次request完成後，另一個長生存期的ajax request就會被送到server端去等待另外一個事件。

Comet的優點是因為client一直保持一個通道，所以server端可以即時將資訊送給client。

其實現可以分為兩類：long polling和streaming。

(i) AJAX (comet_ajax.html)

優點：即為Comet的優點。

缺點：1. php不是刷新，而是一直增加response的值。
      2. 要能處理readyState=3的瀏覽器才能運作。
      
(ii) streaming - Forever IFrame (comet_iFrame.html)

Forever IFrame: 又名為 Forever Iframe(或者 hidden IFrame)，在頁面中藏一個iframe，這個frame的src指向返回事件的server端路徑。

優點：實現簡單，所有有支援iframe的瀏覽器都能用。

缺點：無法處理錯誤或追蹤狀態。

(iii) streaming - Multipart AJAX (comet_ajax_multipart.html)

利用有支援multi-part的瀏覽器，像是Firefox來實作。AJAX請求被發出給server，並保持連通狀態，每次有事件到來時，一個multi-part response就會被寫出。

優點：即為Comet的優點。

缺點：1. PHP每次都是重新刷出，不需要處理字串。(相較於comet_ajax.html中的方式)2. 瀏覽器要能支援multi-part。(好像只有firefox有)

註：PHP須設定'Content-type: multipart/x-mixed-replace; boundary=endofsection'，並留意後續輸出的寫法。

(iv) Long Polling

改良式的long polling：iFrame、multipart、ajax comet等方法都屬於「永遠不會斷線」的做法，但long polling是發一個長時間等待的request，當server有response時斷掉，接著再發一個新的request。看起來跟原本的polling很像，但原本的polling是透過setInterval等定時器，也就是不管server有沒有reponse，時間到就會斷線重連，比較浪費，而且會有時間差。

優點：容易實現錯誤處理與timeout管理。可用在所有的瀏覽器上。

缺點：

TODO: nodejs版的comet



