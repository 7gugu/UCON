@ECHO OFF 
:1
set /p name=<name.txt
if %name%==1 goto 1
goto 2
:2
start Unturned.exe -nographics -batchmode +secureserver\%name%
ping -n 5 127.0.0.1>nul
echo [%time%] ����������%name%>>kf.log
echo [%time%] ����������%name%
echo 1 >name.txt
goto 1