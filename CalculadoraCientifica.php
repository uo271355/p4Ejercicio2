<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<title>Ejercicio 1</title>
<link rel="stylesheet" href="CalculadoraCientifica.css"/>
</head>
<body>
<header>
<h1>Calculadora Cientifica</h1>
</header>
<section>
<pre>
<code>
<?php 
class CalculadoraBasica{
	
	public function __construct(){
		session_start();
	}
	public function digitos(){
		 if (count($_POST)>0) { 
                if(isset($_POST["0"])){
                    $this->digit(0);
                }else if(isset($_POST["1"])){
                    $this->digit(1);
                }else if(isset($_POST["2"])){
                    $this->digit(2);
                }else if(isset($_POST["3"])){
                    $this->digit(3);
                }else if(isset($_POST["4"])){
                    $this->digit(4);
                }else if(isset($_POST["5"])){
                    $this->digit(5);
                }else if(isset($_POST["6"])){
                    $this->digit(6);
                }else if(isset($_POST["7"])){
                    $this->digit(7);
                }else if(isset($_POST["8"])){
                    $this->digit(8);
                }else if(isset($_POST["9"])){
                    $this->digit(9);
                }else if(isset($_POST["+"])){
                    $this->digit('+');
                }else if(isset($_POST["-"])){
                    $this->digit('-');
                }else if(isset($_POST["*"])){
                    $this->digit('*');
                }else if(isset($_POST["punto"])){
                    $this->punto();
                }else if(isset($_POST["/"])){
                    $this->digit('/');
                }else if(isset($_POST["C"])){
                    $this->remove();
                }else if(isset($_POST["mrc"])){
					$this->mrc();
				}else if(isset($_POST["mMenos"])){
					$this->mMenos();
				}else if(isset($_POST["mMas"])){
					$this->mMas();
				}else if(isset($_POST["="])){
                    $this->igual();
                }
		} 
	}
	public function digit($digito){
		if(isset($_SESSION["calculadoracien"])){
			$_SESSION["calculadoracien"] .= strval($digito);
		}else{
			$_SESSION["calculadoracien"] = strval($digito);
		}
	}
	public function ver(){
		if(isset($_SESSION["calculadoracien"])){
			return $_SESSION["calculadoracien"];
		}
	}
	public function mMas(){
		if(isset( $_SESSION['calculadoracien'])) {
            if(isset( $_SESSION['memoria'])) {
                $_SESSION['memoria'] += $_SESSION['calculadoracien'];
			}else{
				$_SESSION['memoria'] = ($_SESSION['calculadoracien']);
			}
		}
    }
	public function mMenos(){
		if(isset( $_SESSION['memoria'])) {
            $_SESSION['memoria'] -= $_SESSION['calculadoracien'];
		}
    }
	public function mrc(){
		if(isset( $_SESSION['calculadoracien'])) {
			if(isset( $_SESSION['memoria'])) {
				$_SESSION['calculadoracien'] = $_SESSION['memoria'];
			}else{
				$_SESSION['calculadoracien'] ="0";
			}
        }
    }
	public function remove(){
		$_SESSION["calculadoracien"]="";
    }
	public function punto(){
		$_SESSION["calculadoracien"].=".";
    }
	public function igual(){
		if(isset($_SESSION["calculadoracien"])){
			try {
				$resultado = $_SESSION["calculadoracien"];
                $_SESSION["calculadoracien"] = eval("return $resultado;");
			}
			catch(Exception $e) {
				$_SESSION["calculadoracien"] = "Error: " . $e->getMessage();
			}
		}
    }
}
class CalculadoraCientifica extends CalculadoraBasica{
	public function __construct(){
		parent::__construct();
	}
	public function digitos(){
		parent::digitos();
		if (count($_POST)>0) { 
			if(isset($_POST["pow2"])){
				$this->pow2();
			}else if(isset($_POST["powy"])){
				$this->digit('**');
			}else if(isset($_POST["pow10"])){
				$this->pow10();
			}else if(isset($_POST["numeropi"])){
			   $this->digit(pi());
			}else if(isset($_POST["mod"])){
				$this->digit('%');
			}else if(isset($_POST["("])){
				$this->digit('(');
			}else if(isset($_POST[")"])){
				$this->digit(')');
			}else if(isset($_POST["raiz"])){
				$this->raiz();
			}else if(isset($_POST["exp"])){
				$this->expo();
			}else if(isset($_POST["log"])){
				$this->logaritmica();
			}else if(isset($_POST["sin"])){
				$this->seno();
			}else if(isset($_POST["cos"])){
				$this->coseno();
			}else if(isset($_POST["tan"])){
				$this->tangente();
			}else if(isset($_POST["fact"])){
				$this->factorial();
			}else if(isset($_POST["MC"])){
				$this->borraMemoria();
			}else if(isset($_POST["masMenos"])){
				$this->masYMenos();
			}else if(isset($_POST["MS"])){
				$this->nuevo();
			}else if(isset($_POST["CE"])){
                    $this->remove();
            }else if(isset($_POST["borra"])){
                $this->remove();
            }
		} 
	}


	public function masYMenos(){
		if(isset($_SESSION["calculadoracien"])){
			$numero=$_SESSION['calculadoracien'];
			$_SESSION['calculadoracien']="(-".$numero.")";
		}
		
	}
	public function nuevo(){
		$_SESSION['memoria']=0;
		if(isset( $_SESSION['calculadoracien'])) {
            if(isset( $_SESSION['memoria'])) {
                $_SESSION['memoria'] += $_SESSION['calculadoracien'];
			}else{
				$_SESSION['memoria'] = ($_SESSION['calculadoracien']);
			}
		}
	}
	public function borraMemoria(){
		$_SESSION['memoria']=0;
		$_SESSION['calculadoracien']="";
	}
	public function pow10(){
		if($_SESSION["calculadoracien"]==""){
			$_SESSION["calculadoracien"]="pow(10,0)";
		}else{
			$_SESSION["calculadoracien"]=pow(10,$_SESSION["calculadoracien"]);
		}
	}
	public function factorial(){
		if($_SESSION["calculadoracien"]==""){
			$_SESSION["calculadoracien"]="1";
		}else{
			$numero=$_SESSION["calculadoracien"];
			$contador=0;
			$result=1;
			while($numero!=$contador){
				$result=$result*($contador+1);
				$contador++;
			}
			$_SESSION["calculadoracien"]=$result;
		}
	}
	public function pow2(){
		if($_SESSION["calculadoracien"]==""){
			$_SESSION["calculadoracien"]="pow(0,2)";
		}else{
			$_SESSION["calculadoracien"]=pow($_SESSION["calculadoracien"],2);
		}
	}
	public function raiz(){
		if($_SESSION["calculadoracien"]==""){
			$_SESSION["calculadoracien"]="sqrt(0)";
		}else{
			$_SESSION["calculadoracien"]=sqrt( $_SESSION["calculadoracien"]);
		}
	}
	public function expo(){
		if($_SESSION["calculadoracien"]==""){
			$_SESSION["calculadoracien"]="exp(0)";
		}else{
			$_SESSION["calculadoracien"]=exp($_SESSION["calculadoracien"]);
		}
	}
	public function logaritmica(){
		if($_SESSION["calculadoracien"]==""){
			$_SESSION["calculadoracien"]="Entrada no valida";
		}else{
			$_SESSION["calculadoracien"]=log($_SESSION["calculadoracien"]);
		}
	}
	public function seno(){
		if($_SESSION["calculadoracien"]==""){
			$_SESSION["calculadoracien"]="sin(0)";
		}else if($_SESSION["calculadoracien"]=="↑"){
			$_SESSION["calculadoracien"]=sin($_SESSION["calculadoracien"]);
		}else{
			$_SESSION["calculadoracien"]=sin($_SESSION["calculadoracien"]);
		}
	}
	public function coseno(){
		if($_SESSION["calculadoracien"]==""){
			$_SESSION["calculadoracien"]="cos(0)";
		}else{
			$_SESSION["calculadoracien"]=cos($_SESSION["calculadoracien"]);
		}
	}
	public function tangente(){
		if($_SESSION["calculadoracien"]==""){
			$_SESSION["calculadoracien"]="tan(0)";
		}else{
			$_SESSION["calculadoracien"]=tan($_SESSION["calculadoracien"]);
		}
	}
}
$calculadoraCientifica = new CalculadoraCientifica();
$calculadoraCientifica->digitos();
?>
</pre>
</code>
</section>
<section class='calculadora'>
<h2>Calculadora</h2>
<form action='#' method='post' name='botones'>
<input type='text' title='pantalla' name='pantalla'  value="<?php 
echo $calculadoraCientifica->ver();?>" readOnly />
<div>
<input type='submit' class='button' name='MC' value='MC'/>
<input type='submit' class='button' name='mrc' value='MR'/>
<input type='submit' class='button' name='mMas' value='M+'/>
<input type='submit' class='button' name='mMenos' value='M-'/>
<input type='submit' class='button' name='MS' value='MS'/>
</div>
<div>
<input type='submit' class='button' name='pow2' value='x²'/>
<input type='submit' class='button' name='powy' value='xʸ'/>
<input type='submit' class='button' name='sin' value='sin'/>
<input type='submit' class='button' name='cos' value='cos'/>
<input type='submit' class='button' name='tan' value='tan'/>
</div>
<div>
<input type='submit' class='button' name='raiz' value='√'/>
<input type='submit' class='button' name='pow10' value='10ͯ'/>
<input type='submit' class='button' name='log' value='log'/>
<input type='submit' class='button' name='exp' value='exp'/>
<input type='submit' class='button' name='mod' value='mod'/>
</div>
<div>
<input type='submit' class='button' name='sube' value='↑'/>
<input type='submit' class='button' name='CE' value='CE'/>
<input type='submit' class='button' name='C' value='C'/>
<input type='submit' class='button' name='borra' value='«'/>
<input type='submit' class='button' name='/' value='·/.'/>
</div>
<div>
<input type='submit' class='button' name='numeropi' value='π'/>
<input type='submit' class='button' name='7' value='7'/>
<input type='submit' class='button' name='8' value='8'/>
<input type='submit' class='button' name='9' value='9'/>
<input type='submit' class='button' name='*' value='x'/>
</div>
<div>
<input type='submit' class='button' name='fact' value='n!'/>
<input type='submit' class='button' name='4' value='4'/>
<input type='submit' class='button' name='5' value='5'/>
<input type='submit' class='button' name='6' value='6'/>
<input type='submit' class='button' name='-' value='-'/>
</div>
<div>
<input type='submit' class='button' name='masMenos' value='+-'/>
<input type='submit' class='button' name='1' value='1'/>
<input type='submit' class='button' name='2' value='2'/>
<input type='submit' class='button' name='3' value='3'/>
<input type='submit' class='button' name='+' value='+'/>
</div>
<div>
<input type='submit' class='button' name='(' value='('/>
<input type='submit' class='button' name=')' value=')'/>
<input type='submit' class='button' name='0' value='0'/>
<input type='submit' class='button' name='punto' value='.'/>
<input type='submit' class='button' name='=' value='='/>
</div>
</form>
</section>

<footer>
	<a href="http://validator.w3.org/check/referer" hreflang="en-us">
		<img src="valid-html5-button.png" alt="¡HTML5 válido!" />
	</a>
	<a href="http://jigsaw.w3.org/css-validator/check/referer">
		<img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="¡CSS Válido!" />
	</a>
</footer>

</body>
</html>
