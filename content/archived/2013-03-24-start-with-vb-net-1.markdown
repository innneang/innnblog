---
author: in
date: 2013-03-24 10:59:53+00:00
draft: false
title: มาเขียนโปรแกรมกันเถอะ [VB.net][Intro]
type: post
url: /2013/03/start-with-vb-net-1/
categories:
- Innn's Diary
- Programmer Zone
tags:
- vb.net
- visual basic
- เขียนโปรแกรม
---

มีผมท่านนึงถามผมมาก่อนปิดเทอมว่า "สอนเขียนโปรแกรมหน่อย" อึ้งไปสามวิ คำว่าเขียนโปรแกรมนี่มันแบ่งแยกย่อยออกเป็นหลายๆภาษา บอกว่าเขียนโปรแกรมแบบนี้เริ่มไม่ถูกกันเลยทีเดียว

นอกจากภาษาไทย อังกฤษ และภาษาต่างๆที่พูดกันแล้ว ในทางคอมพิวเตอร์ก็มีภาษาของคอมพิวเตอร์เช่นกัน ยกตัวอย่าง C#, C++, VB.net, python, Delphi บลา บลา แต่ละภาษาจะมีวิธีการเขียนที่แตกต่างกันไป ที่ถนัดที่สุดของผมคงเป็น VB.net ซึ่งเป็นภาษาแบบ GUI คือมีหน้าตาโปรแกรม ภาษาอื่นๆเช่น python จะไม่มีหน้าตาโปรแกรมทำงานเป็น Command line คือพิมพ์แทนการใช้เมาส์ (แต่สามารถประยุกต์เป็น GUI ได้เหมือนกัน) วันนี้อยากมาแบ่งปันความรู้อันน้อยนิดให้คนอื่นๆมั่ง ถ้าเห็นว่าไร้สาระก็ถือว่าผมเขียนให้เพื่อนผมคนนั้นละกัน

เนื่องจากผมไม่ใช่เทพในด้าน vb.net แค่เขียนเป็นนิดๆหน่อยๆ จนประยุกต์และใช้ในงานได้เท่านั้น #ห๊ะ ผมอาศัยวิธีการลองผิด ลองถูก ดูวิธีทำของฝรั่งแล้วทำตามเท่านั้น



1.ขั้นตอนแรกในการเขียนโปรแกรมภาษา vb.net คือดาวน์โหลดเครื่องมือการเขียนหรือที่เรียกว่า IDE ใช้รันโปรแกรม Compiled โปรแกรม~~~

[![visual basic](https://www.innnblog.com/wp-content/uploads/2013/03/visual.jpg)
](https://www.innnblog.com/wp-content/uploads/2013/03/visual.jpg)

โปรแกรมในการเขียนนั้นคือ Visual Studio หามาใช้ได้จาก[เว็บของ Microsoft ](http://www.microsoft.com/visualstudio/eng/downloads) แนะนำให้เป็น Visual Studio Express 2012 เพราะไม่ต้องเสียเงินทีหลัง ใช้ได้ตลอด พอดาวน์โหลดแล้วก็ติดตั้งให้เรียบร้อย ผมขอข้ามขั้นตอนการติดตั้งครับเครื่องผมมีอยู่แล้ว

2.กดไปที่ New Project ตั้งชื่อที่ชอบอะไรก็ได้ตามใจหรือไม่ต้องตั้งแบบผม OK ไปเลย มันจัดการเอง จะได้หน้าว่างๆขึ้นมา 1 หน้า ด้านข้างจะมีคำว่า Toolbox พอกดจะขึ้นแบบภาพด้านล่าง สามารถลากพวกปุ่มต่างๆลงไปได้ตามสะดวก ผมลาก Button กัน Textbox ลงไป จะได้ตามรูปล่างๆ

[![visual2-vert](https://www.innnblog.com/wp-content/uploads/2013/03/visual2-vert.jpg)
](https://www.innnblog.com/wp-content/uploads/2013/03/visual2-vert.jpg)



3.กดที่ Button1 2 ครั้ง(คลิกๆ)จะเข้าสู่หน้าจอที่ให้เขียน งานมันจะหินตรงนี้และ

ผมลองเขียนว่า


<blockquote>textbox1.text = "https://www.innnblog.com"</blockquote>


คำว่า Textbox1 หมายถึงกล่องข้อความที่ผมลากลงไป, ".text" จะไป เปลี่ยนข้อความใน textbox1 ให้เป็นไปตามข้อความหลัง = ครับ

3.ลองกด Run ที่ลูกศรตัวสีเขียวข้างบนครับ แล้วลองกดปุ่มดูครับ

ตอนที่ 1 มีเพียงเท่านี้ เป็นการอธิบายการใช้โปรแกรมเบื้องต้นเช่นการสร้างโปรเจก เข้าหน้า code ต่างๆครับ
