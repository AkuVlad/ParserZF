$URL = '10.18.32.145/kamarep1/' 
$FirstAnswer = Invoke-WebRequest -Uri $URL -SessionVariable $session
$FirstAnswer.Forms[0].Fields["usr"]="ad"
$FirstAnswer.Forms[0].Fields["pwd"]="ad"
$SecondAnswer = Invoke-WebRequest -Uri ($URL+ $FirstAnswer.Forms[0].Action) -Body $FirstAnswer.Forms[0].Fields -method POST
$ThirdUrl = $URL+ $SecondAnswer.Links[5].href.Replace("&amp;","&")
$ThirdUrl = $ThirdUrl.Replace("item=0","item=1")
$ThirdAnswer = Invoke-WebRequest -Uri $ThirdUrl -SessionVariable $session
Write-Host "Введите дату в формате ДД.ММ.ГГГГ начала выборки эталонной покрышки"
$BeginData = "29.11.2021 07:02:50"
Write-Host "Введите дату в формате ДД.ММ.ГГГГ конца выборки эталонной покрышки"
$EndData = "30.11.2021 07:00:00"
$ThirdAnswer.Forms[0].Fields.Remove("single")
$ThirdAnswer.Forms[0].Fields.Remove("histogram")
$ThirdAnswer.Forms[0].Fields.Remove("limits")
$ThirdAnswer.Forms[0].Fields.Remove("bilanz")
$ThirdAnswer.Forms[0].Fields.Remove("add")
$ThirdAnswer.Forms[0].Fields.Remove("del")
$ThirdAnswer.Forms[0].Fields.Remove("up")
$ThirdAnswer.Forms[0].Fields.Remove("dn")
$ThirdAnswer.Forms[0].Fields.Remove("opt")
$ThirdAnswer.Forms[0].Fields.Remove("submit")
$ThirdAnswer.Forms[0].Fields["refresh"] ="1"
$ThirdAnswer.Forms[0].Fields["start"] = $BeginData
$ThirdAnswer.Forms[0].Fields["end"] = $EndData
$RefreshAnswer =Invoke-WebRequest -Uri $ThirdURL -Body $ThirdAnswer.Forms[0].Fields
$RefreshAnswer.ParsedHtml.getElementsByTagName('option') | %{Write-Host $_.innerhtml}

