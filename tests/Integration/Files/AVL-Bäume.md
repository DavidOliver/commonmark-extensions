Ein [[Binärer verketteter Suchbaum|binär verketteter Suchbaum]] heißt **AVL-Baum**, wenn für jeden Knoten gilt, dass sich die [[Höhe eines Baumes|Höhen]] des linken und rechen Teilbaums um maximal 1 unterscheiden:

_AVL-Eigenschaft_ (AVL-Balancierung):  
$\forall$ Knoten $v: |h($linker Teilbaum von $v) - h($rechter Teilbaum von $v)| \leq 1$

## Balance

Die **Balance** ist der [[Betrag]] der [[Höhe eines Baumes|Höhendifferenz]] zwischen dem rechten Teilbaum und dem linken Teilbaum. Existiert ein Teilbaum nicht, wird $-1$ verwendet.
