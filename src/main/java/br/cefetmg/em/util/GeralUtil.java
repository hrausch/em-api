package br.cefetmg.em.util;

public class GeralUtil {
	
//	private static final String PROP_BIM_ATUAL = "bimestre.atual";
//	private static final String PROP_ANO_ATUAL = "ano.atual";
//	private static final String PROP_ANO_INCIAL = "ano.inicial";
	
	
//	@SuppressWarnings("finally")
//	public static int getAnoAtual(){
//		
//		Properties prop;
//		int anoInicio=0;
//		return 0;
//		
////		try {
////			prop = PropertiesUtilSingleton.getInstance().getProp();
////			anoInicio = Integer.parseInt(prop.getProperty(PROP_ANO_ATUAL) ); 
////		} catch (IOException e) {
////			// TODO Auto-generated catch block
////			e.printStackTrace();
////		}	
////		finally{
////			return anoInicio;
////		}
//		
//	}
	
//	@SuppressWarnings("finally")
//	public static ArrayList<Integer> getAnos(){
//		
//		 Properties prop;
//		 
//		 ArrayList<Integer> resultado = new ArrayList<Integer>();
//		try {
//			prop = PropertiesUtilSingleton.getInstance().getProp();
//			int anoInicio = Integer.parseInt(prop.getProperty(PROP_ANO_INCIAL) ); 
//			int anoFinal = Integer.parseInt(prop.getProperty(PROP_ANO_ATUAL) );
//			
//			for(int ano = anoInicio; ano <= anoFinal; ano++)
//			{
//				resultado.add(ano);
//			}
//			
//		} catch (IOException e) {
//			// TODO Auto-generated catch block
//			e.printStackTrace();
//		}
//		
//		finally{
//			return resultado;
//		}
//		 
//	}
	
//	@SuppressWarnings("finally")
//	public static int getBimestreAtual(){
//		Properties prop;
//		int bim=0;
//		
//		try {
//			prop = PropertiesUtilSingleton.getInstance().getProp();
//			bim = Integer.parseInt(prop.getProperty(PROP_BIM_ATUAL) ); 
//		} catch (IOException e) {
//			// TODO Auto-generated catch block
//			e.printStackTrace();
//		}	
//		finally{
//			return bim;
//		}
//		
//	}
		

	
	/**
	 * Verifica a nota acumulada no ato até o bimestre atual
	 * @param nota
	 * @return
	 */
	public static int verificarSinalAlerta(float nota, int bimestre) {
		
		BimestreUtil bu = new BimestreUtil();
		int idBimestreAtual = bimestre;
		
		int mediaTotalDistribuido = bu.getMediaNotaDistribuido(idBimestreAtual);
		int alertaVermelho = bu.getNotalAlertaVermelho(idBimestreAtual);
		
		
		int alertaSinal = 2;
		
		if(nota < mediaTotalDistribuido && nota > alertaVermelho )
			alertaSinal = 1;
		if(nota <= alertaVermelho )
			alertaSinal = 0;
		
		return alertaSinal;
	}
	
	public static int verificarSinalAlerta(float nota, int mediasPerdidas, int bimestre) {
		
		BimestreUtil bu = new BimestreUtil();
		int alertaSinal = 2;
		int mediasPerdidasToleradas = 2;
		int mediaTotalDistribuido = bu.getMediaNotaDistribuido(bimestre);
		int alertaVermelho = bu.getNotalAlertaVermelho(bimestre);
		
		if(nota < mediaTotalDistribuido && nota > alertaVermelho )
			alertaSinal = 1;
		if(nota <= alertaVermelho || mediasPerdidas > mediasPerdidasToleradas )
			alertaSinal = 0;
		
		return alertaSinal;
	}

}