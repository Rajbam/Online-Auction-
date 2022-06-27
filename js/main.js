function go() {
    var a = 10
    alert(a)
    alert(typeof (a))
    a = 10.5
    alert(a)
    alert(typeof a)
    a = "hello"
    alert(typeof a)
    alert(a)
    a = true
    alert(a)
    alert(typeof a)
}

function go2() {
    var a = 10
    document.write('<h1>' + a + "</h1><br>")
    document.write(typeof (a) + "<br>")
    a = 10.5
    document.write(a + "<br>")
    document.write(typeof a + "<br>")
    a = "hello"
    document.write(typeof a + "<br>")
    document.write(a + "<br>")
    a = true
    document.write(a + "<br>")
    document.write(typeof a + "<br>")
}

function go3() {
    var a = 10
    console.log(a)
    console.log(typeof (a))
    a = 10.5
    console.log(a)
    console.log(typeof a)
    a = "hello"
    console.error(typeof a)
    console.error(a)

    a = true
    console.error(a)
    console.error(typeof a)
}

function go4() {
    //alert(document.getElementById('p1').id);
    // alert();
    // document.getElementById('p1').innerText = "hello world";
    document.getElementById('p1').innerHTML = "<strong class='text-success'>hello world</strong>";
}

// + - / * %
function AMOpt() {
    var a = parseInt(document.getElementById('a').value);
    var b = parseFloat(document.getElementById('b').value);
    //
    //
    // alert(typeof a);
    // alert(typeof b);
    var c = a + b;
    // var c = a - b;
    // var c = a * b;
    // var c = a / b;
    // var c = a % b;
    alert('Result is ' + c)

}

function AssignmentOpt() {
    var a = 10
    console.log(a)
    a += 10
    console.log(a)
    a -= 10
    console.log(a)
    a *= 10
    console.log(a)
    a /= 10
    console.log(a)
    a %= 10
    console.log(a)
}

function ternaryOpt() {
    // let a= 10;
    // let result=

}

function increementOpt() {
    let a = 10;
    console.log(++a);

    console.log(a--);
    console.log(--a);
    // console.log(a)
    //  a++;
    //  a++;
    //  a++;
    //  a++;
    // console.log(a)

}

function relOpt() {

    let a = parseInt(document.getElementById('a').value);
    // let b = parseInt(document.getElementById('b').value);
    let b = document.getElementById('b').value;
    alert(typeof a + '   ===============' + typeof b)

    // 10  =='10'
    let result = a === b;
    // let result = a !== b;
    // let result = a == b;
    // let result = a != b;
    // let result = a > b;
    // let result = a < b;
    // let result = a >= b;
    // let result = a <= b;

    alert(result);
    alert(typeof result);


}

function ternaryOpt() {

    let a = parseInt(document.getElementById('a').value);
    let result = a % 2 === 0 ? "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a> Even no</div>" : "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert'>&times;</a>ODD no</div>";
    document.getElementById('result').innerHTML = result;
    // let a = parseInt(document.getElementById('a').value);
    // let b = parseInt(document.getElementById('b').value);
    // let result = a > b ? "A is greater than B" : "B is greater than A";
    //  alert(result);


}

function logicalOptAnd() {
    let a = parseInt(document.getElementById('a').value);
    let b = parseInt(document.getElementById('b').value);
    let c = parseInt(document.getElementById('c').value);
    // var result = !(a > b && a > c);
    // alert(result)
    if (a > b && a > c) {
        alert("A is the greatest no");
    } else if (b > a && b > c) {
        alert("B is the greatest no")
    } else if (c > a && c > b) {
        alert("C is the greatest no")
    } else {
        alert(" two or more nos are same")
    }
    document.getElementById('a').value = '';
    document.getElementById('b').value = '';
    document.getElementById('c').value = '';

}

function simpleIf() {

    let a = 10
    let b = 50
    if (a >= b) {
        let c = a - b
        console.log(c)
    }
    if (a < b) {
        console.error("value of A must be greater than Value of B")
    }

//a=10
    if (a % 2 === 0) {
        alert('A is an even no')
    } else {
        // alert(' A is  not an even no')
        alert(' A is an Odd no')
    }

}
