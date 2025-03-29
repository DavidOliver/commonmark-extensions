Ein [[Binärer verketteter Suchbaum|binär verketteter Suchbaum]] heißt **AVL-Baum**, wenn für jeden Knoten gilt, dass sich die [[Höhe eines Baumes|Höhen]] des linken und rechen Teilbaums um maximal 1 unterscheiden:

_AVL-Eigenschaft_ (AVL-Balancierung):  
$\forall$ Knoten $v: |h($linker Teilbaum von $v) - h($rechter Teilbaum von $v)| \leq 1$

## Balance

Die **Balance** ist der [[Betrag]] der [[Höhe eines Baumes|Höhendifferenz]] zwischen dem rechten Teilbaum und dem linken Teilbaum. Existiert ein Teilbaum nicht, wird $-1$ verwendet.

## Rotationen

Rotationen werden an einem Knoten durchgeführt, wenn bei ihm die AVL-Eigenschaft verletzt ist.

| **Ist der...**                          | **...linkte Teilbaum zu hoch und...**                      | **...rechte Teilbaum zu hoch und...**                      |
| --------------------------------------- | ---------------------------------------------------------- | ---------------------------------------------------------- |
| **...davon der rechte Teilbaum höher:** | [[AVL-Bäume#Links-Rechts-Rotation\|Links-Rechts-Rotation]] | [[AVL-Bäume#Links-Rotation\|Links-Rotation]]               |
| **...davon der linke Teilbaum höher:**  | [[AVL-Bäume#Rechts-Rotation\|Rechts-Rotation]]             | [[AVL-Bäume#Rechts-Links-Rotation\|Rechts-Links-Rotation]] |

### Einfachrotationen

Einfachrotationen werden durchgeführt, wenn der **äußere Teilbaum** zu hoch ist.

#### Links-Rotation

Das innere Kindelement wird umgehängt.

#### Rechts-Rotation

Das innere Kindelement wird umgehängt.

### Doppelrotationen

Doppelrotationen werden durchgeführt, wenn der **innere Teilbaum** zu hoch ist. Sie bestehen aus **zwei [[AVL-Bäume#Einfachrotationen|Einfachrotationen]]**, was auch algorithmisch so umsetzbar ist.

Doppelrotationen rotieren **zuerst einen Teilbaum**, dann sich selbst.

#### Rechts-Links-Rotation

Es erfolgt eine [[AVL-Bäume#Rechts-Rotation|Rechts-Rotation]] am rechten Teilbaum mit anschließender [[AVL-Bäume#Links-Rotation|Links-Rotation]] am Element.

#### Links-Rechts-Rotation

Es erfolgt eine [[AVL-Bäume#Links-Rotation|Links-Rotation]] am rechten Teilbaum mit anschließender [[AVL-Bäume#Rechts-Rotation|Rechts-Rotation]] am Element.
