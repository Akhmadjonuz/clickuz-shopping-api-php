<h1> Created by @Akhmadjon</h1>
<p style="font-family:Consolas,Monaco,Lucida Console,Liberation Mono,DejaVu Sans Mono,Bitstream Vera Sans Mono,Courier New, monospace;">
1. MySQL uchun table yaratib olamiz.

CREATE TABLE IF NOT EXISTS `clickuz` (
  `id` int(11) NOT NULL,
  `click_trans_id` varchar(200) DEFAULT NULL,
  `merchant_trans_id` varchar(200) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT '0.00',
  `sign_time` datetime DEFAULT NULL,
  `situation` varchar(11) DEFAULT NULL
  `status` varchar(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=utf8;

2. lib.php ni o'zimizga bazamizga moslab login parollarni kiritamiz.

3. comp.php va pre.php ni ham o'zimizga moslab taxrirlaymiz, secret key bilan user id ni kiritamiz.

4. https://merchant.click.uz/home/service ga kirib Prepare URL (Адрес проверки) ushbu bo'limga pre.php uchun urlni ko'rsatamiz,
Complete URL (Адрес результата) urlga kirib comp.php uchun urlni ko'rsatamiz.

5. hamasini to'g'ri qilgan bo'lsangiz aniq ishlaydi.
</p>

# Mualliflik huquqi saqlansin!
# dadabayev.uz
# +998902224311
# telegram: @Akhmadjon

# Copyright reserved!
# dadabayev.uz
# +998902224311
# telegram: @Akhmadjon

# Авторские права защищены!
# dadabayev.uz
# +998902224311
# telegram: @Akhmadjon
	
https://github.com/Akhmadjonuz/Clickuz-Button-Api-php
