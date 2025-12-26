import requests

url = "https://api.ibb.gov.tr/iett/FiloDurum/SeferGerceklesme.asmx"

headers = {
    "Content-Type": "text/xml; charset=utf-8",
    "SOAPAction": "\"http://tempuri.org/GetFiloAracKonum_json\"",
}

xml = """<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
               xmlns:xsd="http://www.w3.org/2001/XMLSchema"
               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <GetFiloAracKonum_json xmlns="http://tempuri.org/" />
  </soap:Body>
</soap:Envelope>
"""

r = requests.post(url, headers=headers, data=xml, timeout=20)

print(r.status_code)
print(r.text[:1000])  # SOAP XML