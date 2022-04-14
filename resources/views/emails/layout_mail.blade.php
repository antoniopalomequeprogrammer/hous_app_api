{{-- <html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        @font-face {
            font-family: 'Gotham-Medium';
            src: url('{{URL::asset("fonts/Gotham-Medium.eot") }}');
            src: url('{{URL::asset("fonts/Gotham-Medium.eot?#iefix") }}') format('embedded-opentype'),
                url('{{URL::asset("fonts/Gotham-Medium.woff2") }}') format('woff2'),
                url('{{URL::asset("fonts/Gotham-Medium.woff") }}') format('woff'),
                url('{{URL::asset("fonts/Gotham-Medium.ttf") }}') format('truetype'),
                url('{{URL::asset("fonts/Gotham-Medium.svg#Gotham-Medium") }}') format('svg');
            font-weight: normal;
            font-style: normal;
        }
    </style>
</head>
<body style="margin: 0px; padding: 0px;" class="js-focus-visible" cz-shortcut-listen="true">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody><tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tbody><tr>
						<td align="center" style="font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="{{URL::asset("images/emails/cabecera_mail.png")}}" alt="" style="display: block;">
						</td>
					</tr>
					<tr style="height: 350px;">
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                            @yield('content')
						</td>
					</tr>
					<tr>
						<td style='background-color: #892647; height: 90px'>
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tbody><tr>
									<td style="color: #ffffff; font-family: 'Gotham-Medium'; font-size: 14px; padding: 20px" width="75%">

									</td>
									<td align="center" style="color: #ffffff; font-family: 'Gotham-Medium'; font-size: 14px;" width="25%">
										Imdeco {{ now()->year }}
									</td>
								</tr>
							</tbody></table>
						</td>
					</tr>
				</tbody></table>
			</td>
		</tr>
	</tbody></table>




</body></html> --}}


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="750" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr style="border-bottom: 1px solid #cccccc; border-collapse: collapse;">
						<td align="center" bgcolor="#ffffff" style="padding: 10px; color: #999; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALgAAAA6CAYAAAADS5MUAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NTg1REUxMEM2NjFFMTFFQkE0MjlDRUZFNTBCQjcxRkUiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NTg1REUxMEQ2NjFFMTFFQkE0MjlDRUZFNTBCQjcxRkUiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo1ODVERTEwQTY2MUUxMUVCQTQyOUNFRkU1MEJCNzFGRSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo1ODVERTEwQjY2MUUxMUVCQTQyOUNFRkU1MEJCNzFGRSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PuZpeFMAAA+4SURBVHja7F0JeBRVEq5JZnIM4UggCEggECDRyE24JQhGcM0HYZWgriyuH65mFWVRWZcbBMWDXV0EEV1AFJFTgiunSgiIIleAoCYiEiCQcCWEZDKZq7dq5gV6errnIJNJg+//vsrMvH6v+72q6uqqeq9ftCDCuREZSfjxBFI8UhBIEDV7Qv2QO9vN0mg0mcDBcRNAI1LuWfgx1V1lVG6InDbujCZEF4dKbuLs41A7gphyj/ak3ATTj8fB/PMJPQjC3zjrOG4aBUfM8LZB2eKVUYLFMkMQhEacfRxqhxatdyx+tvW2geXseTBk/RBc3rfHm7Dh2Jw66ncVUjGkJdq4CDncKjiSz5a4YkVmhL5v97Gxet3YkwZzXfXdijfYfvxcgfQ+KjuPCTgUXRSfYCsrh6qNX8G8+MZ12fdgpF5I/0HKRWVP4OLk8IuC281n5nYY3EAHSY3C1TCO9kjfopLHcZFy+EXBBZMZbB+thwUJjdUyliikVajkGi5WjhoruD3Sy/4B4kyVMLxZfbWMpzvScC5WDr8oOAgCwAcrYT5aca1GNYbzIS5WDv8oOMKUmw/hJ09DRqxq0uLduFg5/Kbgdny4CmbFRUIDbZAaxtSUi5XDrwpuKSwC63eHYGq7KDWMScvFyuFfC46wfpoJGTENICZcx7nKoRr4zdrZSsvAtucg7OrbHbJKKt3WNVoFuGy2QpHRAnux7sErRjDbBC4NDnU/zoPNZmgdEQpjkHzBFbMNlp4qhbm/XITiKguXCof6XBSHn3Jja58a6oJgfFwU/JIcC6ODjFwqHOq04LbKyhq1rx8eAstSu0Lw2yvh+yMF8Nt9KVCl1wecKedGZDTEj6eRIpGWNP/8vXzVSnDDsWfx770eapUiXUI6hrQT0hJ//b0ouAaF2QU/D/nlcRDZEKIXzARNWEiNzmMwmaHjpAVQcroY9Hd1gcJOHX3yeFCAjWqo4Lvxox/7eQGpAyp5qUoVPAv/JvvY6hukacinb7kF98WCl1yBisztEDHqAZdj6/b/CLvzT9m/60N00DgiHLrHtoAB8a1BI5kFpeOzHhwEjy1aB+V5udDSYoUz3boE0nr3ExVFI9G7qttvIbkPQroHb46JqORvcQX3ARUbtoM+pT8ERTV0Kr+zRTQ8vHANWCR+eodmjWHF0w9BjzYtnMpHJiXCU0u/gIoqE1zJzwV9m1gwRAZktrQM6SJSE/ab0jvHVSzDYzdgwe1PbyR6aaUElfy/PMj0EgIq5NUVri/d34EKPja5+7XfcQYzJAg6CDpXBs+9sQIMRuf3FUK0wdC51W3271fRosdsD4wBRVeEFDod6QekPKSxWPabimX4CtkVmfICpMOMqP9KL4T8C5U8mltwH1CZtRf0qfeArk2MU/nMEffAij1H4KqxCiyCDX598I/Xju2vsMAAie/etEG9a9/P2qpAY7OBEBQUCCXfga7KOGbFd3hwaULsj3uALsydIV/9F6RteJ4SH90jWmYwAKkZkoUp6U48j0GxUVpiESroXKboYuzBY4+KfHWagRuKRC5JB1G9Bkh/Rprnpl+0vqczsYY93Q4iHWDGwNux6RifuvqRT/SqpZHdwN/geSpqNch0ssB3dYCoWeNdyudszIYp6762f2/TNAZ+698X9MFBUHBfe2gSEuxUd8CrS2BXXsG134279YZLsa0DEWTSW0Lj2E8KOJOReTYZgVGdyeBYiy4Fvcu3BGk6ti32cD3ah+YNpFSZpyoJ8EOyD3ieiwqBJr11QpmelpIjPZEX+yR1STl+kvT5S6yXKukT9WMMG5/ciyQn7YEqwCfuFJ3xiTI9UzzwaQaep8gDnzrhx6tI9yvw6QPGp0u15qJUg1YZVu074lL+wv19oWVUA/v38oLjEIWe4Koet7sotxWt9ZFTznoRXnolEEEmde4ZUVF/pD4ygegOZvWUFuCQYJ9COoL1e7q5Hm3ZQYwapiCPMKYguVi3h4IVp/zsJFn3w7XueXuqUPLQkvQpimValigoNyEWaTnS/7C+3k3A/jXrhyc+Hcb6vdzwaSIzxA+44dM4xqeetaLg2tYtIKxX52tk+tk13Rqm08L7jw+DjEFJ8Noz6XBicFtIlXlhYktOPlypdJ70MUXUC4TbFiXDl2gRo8mt+0KSaXEHspjbsF07GaGNZUriTV6VApKN2CZY4fgn5DZIyvqjxR4hseCkCN0l9UpFfaLj23wIXP+AtJ5ZfPHYqJ8UjN3tA5+2Yrv2Csr9upf62ozxO97vPrh+cD+77+2RI53b20kJVqsNpmVmOZWFWq1wqXUrNcQtz7gRmklBWcmSLUS6TyQ08oMX+BoegGMXhEsylllA5Z0gY51fx/Iv7bsObDhGTH8PqZWLv34d02VuAE8YgpQhGU+Gm5vEzCy3Ep9SRHyiSZDXfOwPnWc5tu2tigXcUry0ahscPHnOqayVSQCrrm5XKjJ/8p8yh1YhxaPvF8osLW2DJ123kILtxXf/HJmbgfzaR5gVasf8VnH245DYv2QWeTbSBjsBkIJLp5NJqbPx+DHmpw+W2hOkpaLgbbzM+D6z+/OOJ9lA5nZIMZ1Z/+qn3GSZOmuQEnAMIYxPM9n1xbgX2w8S5yZkLDcFpyPZOe5gvLS4xB8Aw1W1dtpkscKLn22F+dv3Ors+6I+X9O6rhi4mM6aKsRwFNkaUgTnPhE3RsTS/TOnHHcw3lb47SpmAXtj+AvtNAcgcrEvuAvnpl5l1Axc3xLM70cvNsTlo3U9UPweYLyvGPOzTi6LfO9lM71pWX+zGpTD37W52kzq5UHie0RI+zcBznay+wUQYRTEAi4dSZZS7p2hmmc4zBevmsBtIjEdVoeCCIMDGQ3kwdd03cPSMa8KhbUQU5Me1UUNX5RRlmkJdEtrLzIJWI5599pN5RL8sUm5xypKyIPtqaTwfMQspvlnEoEmvqTJ9srI0Kt2k4mnofkzBe8tca4qbPkxklljKpyQZPk2TWzaBZWuxTxQYi61//1p3UcpPFUHRrhy4sO9H2eOfH/gJWjz/FqS9s9JFubU2AeJD6kP+0CFqecjESFOSyNgCWWfZkTrbLxPAyp2H8FUAx3EaKPedlvi4ZPs76dNpH46jUmF8Z5g1lcvGSMd31QOfDiqcp5lMk11uxiV1nW6rdQt+/OPNkDN7Cd7nGkjdvRiadHPegCo5IRaqLFZXq11hAkNST8hLiFeTFxXmq9elUC6nNPWYG1JTlDF3px7z453CCKSx9ptJfqs76T589X3kR1V1vkFS7mkdtdR/DlXoDyHCzXmku1CZAxdkohuy7x/vuubk6oXDlGEDrkdElRaI7HU3nBg9GorUpdz+hJw189d2FztQeWny7i6Z6zS33wDK+zielvzugY/9tgoBd5JMNuaUn/kkd76RCv0hXX5Q2j6gWZTi3YehdOd+l/JxKb2gbXSk/XsJ3uxXo5vALQ5Ky0n9yFdQSH1lBPcC0jmkPKSBXl8hLZGsqdzkzzw3u39JF/yQfnzMgmJxn6JlAkPCFj/z6YAMnybh9ftL+kPjeV3ix9v7E/Ags/DdT6FR/64AwdfnK3T4fW56CqQvWA0Xw0Mgfss2yBuWestqN/qdZhQKTSu/JHFRsrB8GX5+x36nw/WcO/mja/B4MwryvLzUSpb2S5Kkz0ax1J8Um5GKJL4v3XRH8bqLwLGqkpQoQ8ZfPwCuE03+4BNNhD0ncUMow0LBKQWVlGl5TCZAJt9+ccDz4MZT58CwJdv1udMzEfq0c8QmpyuvgD4A0/J1jFeZTywGZQyeBMcU+XxwnVCiR1tDH6w4CXmCzJG5bEZTqlAUG0xWCK4p10z5/hkyyk0+9nhfFl/5gNn2B7srnyiW+BRpkYxyExZjf3LrZKKnfPUmsFW4xlnzHhlif/nBoNNCzNatN4OS2mpgnejRS8spDT4024LtfAtE0xIpZ71eUtpaYhXF/aKba5mPw5mA7Xb7kU82UX8odfqwQsCpBHoCPl/tYwVeK65WQMWazS7lZMHpRQd79iXYBlGnTtdF9y7IZD+qZw9PSMpzPZzrpLugCYX3PTiWfXrzQsUamSDKW0yUUZBJaMWVgp0nmOX05AqVI/0Vx/GOpFyaPjzm4TxSvv4k4RNNdtEyh7NejHU10lBsU1VnCk4wbMoCa7Hrkoq56ffaX3awBmkgMntnXfjHtKZY/BpXNrMIwNyGbSKhPOvhdPNZe8LP4Jj4kV6P/NZEZlEPyqTdNiGlYL10t+vC3VtxWvUmXfdCrs50BR4ISDTBQzndxTKKRWN/E6kd1vtA5hTvigJOSlmO89DDBSI+5Utik+o+ZYEj7fkCOCa+xO5QBTMAA7HeKKSy6gN+XQ/e4ImRLoutcuYsdeTBGTp2agm33+7ImIT16QqNXnrS5Tw0XT9vs2P9T8u2d8CZLp186UaN14OzyLwDC/QOy6wFD622EF6eKwzrG72sSznklkxoF7Cd+3/N4vrScSaOP02mHjGdFD1SVGqx31xpifle9Ivyz7QZ/HmlyR+ZNr7yyev6bF0QrZ2pUlwnD3W8j5/x+xz6t4SgS3BOtU4ZlgxLsw/BZfTThaM5oOncEYQAb8/sbqsIX4TG6ht9qGtgVsy/SEssQSWnRWD/lsh/LosFPPWrnLkkvoy7qrbqU4aFknKe6gXVJFCSwnrZdWcFw9kLyg0EAcqWrgXB4jyR1UgfBp1iHIF6Yb1QiMvaCRyKoJVph0W0103dhczlEde/paFh622P1MbJjx45A4WFzhkesYvi1BF9ODRcOBMGTl8Mey87pwijjCYoe2gUWEK82m/FLy4Kx62BWg0ydTrXl0+0WvkXUgRDJZhWb4K3/+L6H0guh4VAk19PcGlx+Ixa9cHjE5pBXLvr+9GTG62k4HZ3Zms2dEkdBEP/lA47i8quK39QMBTVj/D2smYuVg6xgtfafwumSRs5K67sxNvA+NE6WDRmJLSp1MANTosVc7FyiF0UVW3Mbdx7GJqWlsKTzW/4BeP9XKwcAfHBbxSGJWvgjQ5REB58Q6nBz7hYOVSt4ObjBaDLzYPpLXzeOnkXpCVu4WLlECu4VY0dq/gkE55rH+2yIZAb0Mq8R7hIOVRvwe3x5vlLYNuxBxa28sqK03qOPmi9C7lIOW4KBbdb8TWbYXhMJMRHyE7w0LJRWlNLWxHQHnwFXJwcUlCasFStnaM148a1myFnSPKh8P0XxdsBGFGh+T/z4fAIe5ri3IgMWn+boMoOarXQZP50C+iCh2obR37NRcZxIy7KZLV2kBZiXV2+Xgs2YZkgCBouMg6fFbz55+/RK01/B5VmVGhZre1yaXNLYfFTXGQcPrso1UBXhdwU2u2fNiQJVlNHQ7slRkY8Oiw0JK5Vby42Dm/xfwEGAF7FM8az1lgeAAAAAElFTkSuQmCC" height="60" width="200" alt="imagen aqui" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">

									<tr>
										<td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px;">
                                            @yield('content')
										</td>
									</tr>

								<tr>
									<td style="padding: 20px 0 30px 0; color: #999; font-family: Arial, sans-serif; font-size: 14px; line-height: 20px;">

									</td>
								</tr>
								<tr>
									<td>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td width="260" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td style=" text-align:center, padding: 25px 0 0 0; color: #999; font-family: Arial, sans-serif; font-size: 12px; line-height: 20px;">

															</td>
														</tr>
													</table>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">
													&nbsp;
												</td>
												<td width="260" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td style="padding: 25px 0 0 0; color: #999; font-family: Arial, sans-serif; font-size: 12px; line-height: 20px;">

															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ec546c" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
									 <br/>
										<a href="#" style="color: #ffffff;">
										<font color="#ffffff">¡Visítanos</font>, gracias!</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
