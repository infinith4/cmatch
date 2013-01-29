#!/usr/bin/perl

#// 準備
  $cknm = 'SESSID';
  $test = genUniqID();#「ランダムなuniqid」

  $test =~ s/(\.|\,)//g;

#// クッキー取得
  if ($ENV{'HTTP_COOKIE'}) {
    *data = GetCookie($ENV{'HTTP_COOKIE'});
    @w = split(/\,/, $data{$cknm});
    $test = @w[0];
  }

#// クッキーセット
  $ckrec = "sess$test\,";
  print "Content-type: text/html\n";
  print "Set-Cookie: $cknm=$ckrec;\n";
  print "Location: index.php\n\n";
#// 終了
  exit(0);
  
#//=====================================================================
#//  クッキー取得
#//=====================================================================
sub GetCookie
{
  local($cookie) = $ENV{'HTTP_COOKIE'};
  local(*data, @cookie, $key, $val);

#// クッキー取得
  @cookie = split(/ /, $cookie);
  foreach (@cookie) {
    ($key, $val) = split(/=/);
    $data{$key} = $val;
  }

#// 戻り値セット
  return *data;
}


use strict;
use Digest::MD5 qw(md5 md5_hex md5_base64);

sub genUniqID{
  my $seed = shift || 'fjfhgliughvggkyfhfjfl';
  my $id = join(''
          , $ENV{'REMOTE_ADDR'}
          , $ENV{'HTTP_USER_AGENT'}
          , time
          , $$
          , rand(9999)
          , $seed
      );

return(md5_hex($id));
}

