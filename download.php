<?php include('./header1.inc'); ?>

<h1>Quantitative prediction of the effect of genetic variation using hidden Markov models</h1>
<p>Mingming Lui, Layne T. Watson and Liqing Zhang</p>
<p>Computer Science, Virginia Tech</p>
<div id="abstract">Abstract: </div>
<hr>
<p>
	<b>Background:</b>
	With the development of sequencing technologies, more and more sequence variants
	are available for investigation. Different classes of variants in the human genmore
	have been identified, including single nucleotide substitutions, insertion and
	deletion, and large structural variations such as duplications and deletions.
	Insertion and deletion (indel) variants comprise a major proportion of human
	genetic variation. However, little is known about their effects on humans. The
	absence of understanding is largely due to the lack of both biological data and
	computational resources.
	<br>
	<b>Results:</b>
	This paper presents a new indel functional prediction method HMMvar based on HMM
	profiles, which capture the conservation information in sequences. The results
	demonstrate that a scoring strategy based on HMM profiles can achieve good
	performance in identifying deleterious or neutral variants for different data
	sets, and can predict the protein functinoal effects of both single and multiple
	mutations.
	<br>
	<b>Conclusions:</b>
	This paper proposed a quantitative prediction method, HMMvar, to predict the
	effect of genetic variation using hidden Markoc models. The HMM based pipeline
	program implementing the method HMMvar is freely available at
	https://bioinformatics.cs.vt.edu/zhanglab/hmm.
</p>
<hr>
<div id="download">
	<a href="https://bioinformatics.cs.vt.edu/zhanglab/hmm/hmmVar1.1.0.tar.gz">Download HMMvar</a>
</div>
<p>Contact: lqzhang at cs dot vt do edu</p>

<?php include('./footer1.inc'); ?>