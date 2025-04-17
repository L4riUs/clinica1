async function algo (){
    let cc = fetch("src/Controller/C_Login.php/?printLogin");

    let res = (await cc).json();
    console.log(res);
}
algo();

