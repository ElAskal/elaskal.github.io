    function checkUser(user)
    {
      if (user.value == '')
      {
        document.getElementById('info').innerHTML = ''
        return
      }
      params  = "user=" + user.value
      request = new ajaxRequest()
      request.open("POST", "/../checkuser.php", true)
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
      request.setRequestHeader("Content-length", params.length)
      request.setRequestHeader("Connection", "close")
      request.onreadystatechange = function()
      {
    	  
        if (this.readyState == 4)
          if (this.status == 200)
            if (this.responseText != null){
            	document.getElementById('info').innerHTML = this.responseText
            }
      }
      request.send(params)
   //   O('info').innerHTML = 'Test'
    }

    function ajaxRequest()
    {
    	// Check browser function
      try { var request = new XMLHttpRequest() }
      catch(e1) { 
       //		IE6+ check 
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }

        catch(e2) {
        	  //		IE5 check 
          try { request = new ActiveXObject("Microsoft.XMLHTTP") }
          catch(e3) {
            request = false
      } } }
      return request
    }