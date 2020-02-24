<%EnableSessionState=False
host = Request.ServerVariables("HTTP_HOST")

if host = "teyssieux.fr" or host = "www.teyssieux.fr" then response.redirect("https://www.teyssieux.fr/")

else
response.redirect("https://www.teyssieux.fr/error.htm")
end if
%>