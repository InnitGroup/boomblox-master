game:GetService("Visit"):SetUploadUrl("{UploadUrl}")
game:HttpGet("http://{Url}/Game/Statistics.ashx?TypeID=3&UserID={UserId}")
game:Load("http://{Url}/Data/Get.ashx?id={PlaceId}&t="..math.random(1,50000))