<?php

use Illuminate\Database\Seeder;
use Infoclinic\Model\Especialidade;

class EspecialidadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Especialidade::create(['nome'=>'Acupuntura ','descricao'=>'Ramo da medicina tradicional chinesa e um método de tratamento chamado complementar de acordo com a nova terminologia da OMS.']);
        Especialidade::create(['nome'=>'Alergia e Imunologia','descricao'=>'Diagnóstico e tratamento das doenças alérgicas e do sistema imunológico.']);
        Especialidade::create(['nome'=>'Alergia e Imunologia infantil','descricao'=>'Diagnóstico e tratamento das doenças alérgicas e do sistema imunológico para crianças.']);
        Especialidade::create(['nome'=>'Angiologia','descricao'=>'É a área da medicina que estuda o tratamento das doenças do aparelho circulatório.']);
        Especialidade::create(['nome'=>'Cardiologia	','descricao'=>'Aborda as doenças relacionadas com o coração e sistema vascular.']);
        Especialidade::create(['nome'=>'Cardiologia	Congenita','descricao'=>'É a área que refere-se às doenças do coração e/ou dos vasos sanguíneos']);
        Especialidade::create(['nome'=>'Cirurgia Cardiovascular','descricao'=>'Tratamento cirúrgico de doenças do coração.']);
        Especialidade::create(['nome'=>'Cirurgia Geral','descricao'=>'É a área que engloba todas as áreas cirúrgicas, sendo também subdividida.']);
        Especialidade::create(['nome'=>'Cirurgia Pediátrica	','descricao'=>'Cirurgia geral em crianças.']);
        Especialidade::create(['nome'=>'Cirurgia Plástica','descricao'=>'Correção das deformidades, malformações ou lesões que comprometem funções dos órgãos através de cirurgia de caráter reparador ou cirurgias estéticas.']);
        Especialidade::create(['nome'=>'Clínica Médica','descricao'=>' É a área que engloba todas as áreas não cirúrgicas, sendo subdividida em várias outras especialidades.']);
        Especialidade::create(['nome'=>'Coloproctologia','descricao'=>'É a parte da medicina que estuda e trata os problemas do intestino grosso (cólon), sigmoide e doenças do reto, canal anal e ânus.']);
        Especialidade::create(['nome'=>'Dermatologia','descricao'=>'É o estudo da pele anexos (pelos, glândulas), tratamento e prevenção das as doenças.']);
        Especialidade::create(['nome'=>'Endocrinologia e Metabologia','descricao'=>'É a área da Medicina responsável pelo cuidados aos hormônios, crescimento e glândulas como adrenal, tireoide, hipófise, pâncreas endócrino e outros.']);
        Especialidade::create(['nome'=>'Endocrinologia Pediátrica','descricao'=>'Endocrinologia em crianças']);
        Especialidade::create(['nome'=>'Fonoaudiologia','descricao'=>'É área da saúde que trabalha com os diferentes aspectos da comunicação humana: linguagem oral e escrita, fala, voz, audição e funções responsáveis pela deglutição, respiração e mastigação.']);
        Especialidade::create(['nome'=>'Gastroenterologia','descricao'=>'É o estudo, diagnóstico, tratamento e prevenção de doenças relacionadas ao aparelho digestivo, desde erros inatos do metabolismo, doença do trato gastrointestinal, doenças do fígado e cânceres.']);
        Especialidade::create(['nome'=>'Gastroenterologia Pediátrica','descricao'=>'Gastroenterologia em crianças']);
        Especialidade::create(['nome'=>'Geriatria','descricao'=>'É a subespecialidade médica que cuida dos idosos e articula seu tratamento com outras especialidades.']);
        Especialidade::create(['nome'=>'Ginecologia e Obstetrícia','descricao'=>'É a especialidade médica que aborda de forma integral a mulher. Trata desde as doenças infecciosas sexuais, gestação, alterações hormonais, reprodução.']);
        Especialidade::create(['nome'=>'Hematologia e Hemoterapia','descricao'=>'É o estudo dos elementos figurados do sangue (hemácias, leucócitos, plaquetas) e da produção desses elementos nos órgãos hematopoiéticos (medula óssea, baço, linfonódos), além de tratar das anemias, linfomas, leucemias e outros cânceres, hemofilia e doenças da coagulação.']);
        Especialidade::create(['nome'=>'Hematologia Pediátrica','descricao'=>'Hematologia para crianças']);
        Especialidade::create(['nome'=>'Hepatologia','descricao'=>'É uma área de atuação do gastroenterologista.']);
        Especialidade::create(['nome'=>'Homeopatia','descricao'=>'É uma área muito explorada em tratamentos alternativos que se mostram muito eficientes, especialmente por conta de não serem tão agressivos como os remédios convencionais, já que são mais naturais.']);
        Especialidade::create(['nome'=>'Infectologia','descricao'=>'Prevenção, diagnóstico e tratamentos de infecções causadas por vírus, bactérias, fungos e parasitas (helmintologia, protozoologia, entomologia e artropodologia).']);
        Especialidade::create(['nome'=>'Mastologia','descricao'=>'Subespecialidade que trata da mama, suas doenças, alterações benignas e estéticas.']);
        Especialidade::create(['nome'=>'Medicina Esportiva','descricao'=>'Abordagem do atleta de uma forma global, desde a fisiologia do exercício à prevenção de lesões, passando pelo controle de treino e resolução de problemas de saúde que envolvam o praticante do exercício físico.']);
        Especialidade::create(['nome'=>'Nefrologia','descricao'=>'É a parte da medicina que estuda e trata clinicamente as doenças do rim, como insuficiência renal.']);
        Especialidade::create(['nome'=>'Nefrologia Pediátrica','descricao'=>'É a parte da medicina que estuda e trata clinicamente as doenças do rim, como insuficiência renal em crianças.']);
        Especialidade::create(['nome'=>'Neurologia','descricao'=>'É a parte da medicina que estuda e trata o sistema nervoso.']);
        Especialidade::create(['nome'=>'Neurologia Pediátrica','descricao'=>'É a parte da medicina que estuda e trata o sistema nervoso para crianças.']);
        Especialidade::create(['nome'=>'Nutricionista','descricao'=>'É a área da saúde que desenvolve ações no âmbito da atenção dietética e/ou segurança alimentar, destinadas tanto a um indivíduo como a um grupo populacional.']);
        Especialidade::create(['nome'=>'Nutrição Clínica','descricao'=>'Área da nutrição responsável pelo tratamento de diversas enfermidades que afetam as pessoas, a nutrição clínica é aplicada aos pacientes por meio de um plano focado na alimentação adequada.']);
        Especialidade::create(['nome'=>'Nutrição Esportiva','descricao'=>'É a área que aplica a base de conhecimentos em: nutrição, fisiologia e bioquímica no esporte e atividade física. Os principais objetivos da nutrição esportiva são: Aumentar o desempenho físico, desportivo, evolucional e hibernolar do atleta ou jogadores.']);
        Especialidade::create(['nome'=>'Nutrologia','descricao'=>'É a especialidade médica clínica que se dedica ao diagnóstico, prevenção e tratamento de doenças do comportamento alimentar. Os médicos nutrólogos não devem ser confundidos com nutricionistas.']);
        Especialidade::create(['nome'=>'Odontologia','descricao'=>'É a área da saúde humana que estuda e trata do sistema estomatognático - compreende a face, pescoço e cavidade bucal, abrangendo ossos, musculatura mastigatória, articulações, dentes e tecidos.']);
        Especialidade::create(['nome'=>'Oftalmologia','descricao'=>'É a parte da medicina que estuda e trata os distúrbios dos olhos.']);
        Especialidade::create(['nome'=>'Oftalmologia Pediátrica','descricao'=>'É a parte da medicina que estuda e trata os distúrbios dos olhos em crianças.']);
        Especialidade::create(['nome'=>'Ortopedia e Traumatologia','descricao'=>'É a parte da medicina que estuda e trata as doenças do sistema osteomuscular, locomoção, crescimento, deformidades e as fraturas.']);
        Especialidade::create(['nome'=>'Otorrinolaringologia','descricao'=>'É a parte da medicina que estuda e trata as doenças da orelha, nariz, seios paranasais, faringe e laringe.']);
        Especialidade::create(['nome'=>'Pediatria','descricao'=>'É a parte da medicina que estuda e trata crianças.']);
        Especialidade::create(['nome'=>'Pneumologia','descricao'=>'É a parte da medicina que estuda e trata o sistema respiratório.']);
        Especialidade::create(['nome'=>'Pneumologia Pediátrica','descricao'=>'É a parte da medicina que estuda e trata o sistema respiratório em crianças.']);
        Especialidade::create(['nome'=>'Psicologia','descricao'=>'É a área que trata do o comportamento, a experiência subjetiva e os processos mentais a eles subjacentes.']);
        Especialidade::create(['nome'=>'Psiquiatria','descricao'=>'É a parte da medicina que previne e trata ao transtornos mentais e comportamentais.']);
        Especialidade::create(['nome'=>'Psiquiatria Pediátrica','descricao'=>'É a parte da medicina que previne e trata ao transtornos mentais e comportamentais em crianças.']);
        Especialidade::create(['nome'=>'Reumatologia','descricao'=>'É a especialidade médica que trata das doenças do tecido conjuntivo, articulações e doenças autoimunes. Diferente do senso comum o reumatologista não trata somente reumatismo.']);
        Especialidade::create(['nome'=>'Reumatologia Pediátrica','descricao'=>'É a especialidade médica que trata das doenças do tecido conjuntivo, articulações e doenças autoimunes em crianças.']);
        Especialidade::create(['nome'=>'Urologia','descricao'=>'É a parte da medicina que estuda e trata cirurgicamente e clinicamente os problemas do sistema urinário e do sistema reprodutor masculino e feminino.']);
    }
}
