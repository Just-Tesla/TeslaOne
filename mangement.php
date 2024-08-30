function bot($token,$method,$datas=[]){
    $url = "https://api.telegram.org/bot".$token."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res);
}


$args = $_SERVER['argv'];
if($args[1]=='update'){
    passthru('clear && figlet Tesla && sudo apt update && sudo apt upgrade && clear && echo Update success.');
    exit();
}elseif($args[1]=='backup'){
$token = readline("Enter your token: ");
echo "
";
$id = readline("Enter your ID: ");
passthru("zip -r /root.zip ../root");
passthru("zip -r /html.zip ../var/www/html");
bot($token,'SendDocument',[
'chat_id'=>$id,
'document'=>new CURLFile('root.zip'),
'caption'=>'Tesla BackUp',
]);
bot($token,'SendDocument',[
'chat_id'=>$id,
'document'=>new CURLFile('html.zip'),
'caption'=>'Tesla BackUp',
]);
}
passthru("sudo rm -rf /etc/hostname");
passthru("sudo cp /etc/apt/sources.list /etc/apt/sources.list.backup");
file_put_contents("/etc/hostname", "TESLA");
file_put_contents("/etc/hosts", file_get_contents("https://raw.githubusercontent.com/Just-Tesla/TeslaOne/main/hosts"));
file_put_contents(".p10k.zsh", file_get_contents("https://raw.githubusercontent.com/Just-Tesla/TeslaOne/main/.p10k.zsh"));
file_put_contents(".zshrc", file_get_contents("https://raw.githubusercontent.com/Just-Tesla/TeslaOne/main/.zshrc"));
file_put_contents("/etc/apt/sources.list", file_get_contents("https://raw.githubusercontent.com/Just-Tesla/TeslaOne/main/sources.list"));

function startup() {

    passthru("clear");
    passthru("figlet TESLA");
    sleep(1);
    
    echo "
Developer: @Best2G

Please choose an action from the Menu:

[1] Update Libraries and Upgrade to the latest version.
[2] Change password.
[3] Reboot.
[4] Create a Username in the server.
[5] Check Server Usage.
[6] Check Server Info.
[7] Check Server Tasks.
[8] Install Custom apps and Programming Languages.
[9] Exit the system and back to command line.

";

    return readline("BOSS@TESLA : ");
}

while (true) {
    $choice = startup();

    switch ($choice) {
        case 1:
            passthru("sudo apt update -y && sudo apt upgrade -y");
            sleep(1);
            passthru("clear");
            echo "Updated successfully.";
            sleep(1);
            break;

        case 2:
            passthru("clear");
            passthru("sudo passwd");
            passthru("clear");
            echo "Password Changed. Now Rebooting...";
            sleep(2);
            passthru("sudo reboot");
            break;

        case 3:
            passthru("clear");
            echo "Rebooting...";
            sleep(2);
            passthru("sudo reboot");
            break;

        case 4:
            passthru("clear");
            $username = readline("Enter the new username: ");
            passthru("sudo adduser " . escapeshellarg($username));
            echo "User $username created successfully.";
            sleep(1);
            break;

        case 5:
            passthru("clear");
            passthru("sudo top");
            break;

        case 6:
            passthru("clear");
            passthru("sudo neofetch");
            sleep(3);
            break;

        case 7:
            passthru("clear");
            passthru("sudo top");
            break;

        case 8:
            passthru("clear");
            echo "Coming Soon";
            sleep(1);
            break;

        case 9:
            passthru('clear');
            echo "Exiting... Goodbye.";
            sleep(2);
            passthru('clear');
            passthru("neofetch");
            exit();

        default:
            echo "Invalid choice. Please try again.";
            sleep(2);
            break;
    }
}
