---
author: in
date: 2015-05-04 10:39:45+00:00
draft: false
title: จัดการ VPS DigitalOcean ด้วย Vesta Control Panel
type: post
url: /2015/05/install-vesta-panel-in-digitalocean/
categories:
- Programmer Zone
tags:
- digitalocean
- vps
---

เนื่องจากเมื่อเดือนที่แล้วผมได้ย้ายเว็บตัวเองจาก Shared Host มาเป็น VPS ที่ [DigitalOcean](https://www.innnblog.com/digital-ocean-high-quality-vps/) เป็นครั้งที่สอง [[ครั้งแรก](https://www.innnblog.com/from-shared-host-to-vps/)ที่ย้ายกลับ]

ปกติโฮสต์ที่ให้บริการส่วนใหญ่ในไทยก็จะเป็น Directadmin ที่คนใช้เยอะๆ หรือที่แพงๆหน่อยก็เป็น cPanel แต่สองตัวนี้มีข้อจำกัดครับ

คือมันเสียตัง...

<!-- more -->


## ในบทความนี่ ผมจะใช้ DigitalOcean เป็นหลักนะครับ ใครยังไม่มี สมัครได้ที่ [คลิกนี่](https://goo.gl/FQYxBV) ซึ่งลิงค์นี่เป็น Refferal Link นะครับ คือใครกดผ่านลิงค์นี้แล้วจ่ายเงินครั้งแรก $25 จะได้เพิ่มอีก $10 รวมเป็น $35 ซึ่ง $35 นี่ใช้ได้ประมาณ 7 เดือนพอดี :3


![list_user](https://www.innnblog.com/wp-content/uploads/2015/05/list_user-1.jpg)
.

เนื่องจากความงก เราเลยหาของฟรีแทน ซึ่งจากการค้นคว้าผ่าน Google แล้ว พบว่า ZPanel ที่เคยใช้คราวก่อนมันเลิกซัพพอร์ต Ubuntu เวอร์ชั่นใหม่ๆแล้วแถมคนส่วนใหญ่ยังบอกว่าไอ้นี่มันช่องโหว่เยอะ จึงตัดออกจากตัวเลือกไป และมาเจอ Vesta Panel ในบอร์ด Thaihosttalk [เจ้าของ Shared Host ที่ผมย้ายออกมาเป็นคนเอามาโพส โฮะๆ]


### และจากการค้นคว้าต่อไป ก็สรุปได้เลยว่าไอ้ตัวนี้ดีสุด [อีคราวก่อนอินก็พูดงี้และ (แต่มันดีจริงๆนะ)]


คือพอเห็นความสามารถแล้ว คือแบบ Directadmin ตกงานเลยอะ ขายแพงกว่า แต่มันทำได้เท่ากัน


# ความสามารถของ VestaCP


![vesta-features](https://www.innnblog.com/wp-content/uploads/2015/05/vesta-features.png)


จากที่เห็นจะพบว่าดีพอๆกับ Directadmin เลย ที่ผมรู้ว่าสำคัญและขาดอยู่อย่างเดียวคือ Online File Manager [แต่ก็ใช้ FTP แทนกันได้และ] ที่ชอบที่สุดและไม่คิดว่าจะมีในนี้คือระบบ Autoupdates ครับ!!! แถมรองรับ SNI ด้วย \\โฮสต์แพงๆบางที่ยังไม่ให้ใช้เลย


# วิธีติดตั้ง


ตั้งค่า Droplet ใน [DigitalOcean ](https://www.innnblog.com/digital-ocean-high-quality-vps/)ก่อน ให้เลือกเป็น Ubuntu เวอร์ชั่นใดก็ได้ ตั้งแต่ 12.04 ขึ้นไปตามรูปครับ

[คือจะเลือก CentOS หรือ Debian ก็ได้นะครับ แต่ผมใช้ไม่เป็น ดังนั้นมีปัญหาอะไรถามผมไม่ได้นะครับ :3]

![digitalocean-imageselect](https://www.innnblog.com/wp-content/uploads/2013/12/digitalocean-imageselect.png)


ตั้งค่าเสร็จแล้ว กด Deploy รอ 55 วินาที แล้วใช้ Putty ต่อเข้าไป หากใครมีปัญหาอะไร ไปอ่านบทความ [DigitalOcean ](https://www.innnblog.com/digital-ocean-high-quality-vps/)ที่ผมเคยเขียนไว้ได้ หรือไปดู[วิธีติดตั้ง VPN](https://www.innnblog.com/howto-setup-vpn-in-vps/) เป็นแนวทางได้เหมือนกัน

ตามหน้าเว็บ Doc ของ VestaPanel จะพบว่า VestaPanel นี่เป็นอะไรที่ติดตั้งง่ายที่สุดแล้ว เพราะพิมพ์แค่ 3 คำสั่ง ที่เหลือมันจัดการเอง \\เหย้ดดด แต่มีข้อแม้ว่า VPS ที่เราเอามาใช้นั้นต้องเป็นเครื่องเปล่าห้ามติดตั้งอะไรมาก่อนไม่งั้นจะเจอ Error

#    ระบบปฏิบัติการที่รองรับ
#    RHEL 5, RHEL 6
#    CentOS 5, CentOS 6
#    Debian 7
#    Ubuntu 12.04, Ubuntu 12.10, Ubuntu 13.04, Ubuntu 13.10, Ubuntu 14.04


<blockquote>

> 
> # เชื่อม Server  \\หากใช้ Putty ก็ไม่ต้องพิมพ์นะครับ 555+
> 
> 


> 
> ## ssh root@your.server
> 
> 

> 
> # ดาวโหลดน์สคริป
> 
> 


> 
> ## curl -O http://vestacp.com/pub/vst-install.sh
> 
> 

> 
> # เริ่มติดตั้ง! อาจจะมีให้ตั้งค่าตอนติดตั้งบ้างอะไรบ้างก็จิ้มๆไปผมไม่ได้แคพมาให้นะครับ
> 
> 


> 
> ## bash vst-install.sh
> 
> 
</blockquote>




### ที่สำคัญตอนเสร็จสิ้น มันจะให้รหัส admin ต่างๆเรามาก็อย่าลืมจดไว้นะครับ เดียวต้องไปค้นในไฟล์ Config อีก


เพียงเท่านี้เราก็จะได้ Panel สุดเจ๋งมาแว้ววว สามารถเพิ่ม Web แล้วชี้ A record มาได้เลย หรือจะตั้งค่า nameserver ใช้เองก็ได้เลย

หากใครต้องการตั้งค่า Nameserver แล้วหาวิธีทำไม่ถูก อ่านจาก Document ได้ที่ [https://vestacp.com/docs/#how-to-setup-vanity-nameservers](https://vestacp.com/docs/#how-to-setup-vanity-nameservers) ครับ




## หากใครมีคำถามอะไร ฝากไว้ที่กล่องคอมเมนท์ด้านล่างได้ครับ ผมผ่านมาเมื่อไรจะมาทยอยตอบให้ หรือหากต้องการคำตอบด่วน ก็สามารถส่งเมลล์มาถามได้ที่ in@innnblog.com ครับ




ลิงค์เพิ่มเติม อ่านได้: [https://vestacp.com/](https://vestacp.com/), [https://vestacp.com/docs/](https://vestacp.com/docs/)


